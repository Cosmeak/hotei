<?php

namespace App\Http\Controllers\BackOffice;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Course;
use App\Models\Craftman;
use App\Models\Craftsmanship;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $user = Auth::user();
        $projects = Project::query()
            ->when($user->role != UserRole::Admin->value)
            ->paginate(100)
            ->withQueryString();

        return Inertia::render('BackOffice/Project/Index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $user = Auth::user();
        $craftmen = collect();
        if ($user->role == UserRole::Admin) {
            $craftmen = Craftman::query()->with('user')->get();
        }
        $courses = Course::query()
            ->when(
                Auth::user()->role !== UserRole::Admin->value,
                fn($query) => $query->where('craftman_id', optional(Auth::user()->craftman)->id)
            )
            ->when(
                Auth::user()->role === UserRole::Admin->value,
                fn($query) => $query->with('craftman.user')
            )
            ->get();

        $craftsmanships = Craftsmanship::all();

        return Inertia::render('BackOffice/Project/Create', [
            'courses' => $courses,
            'craftmen' => $craftmen,
            'craftsmanships' => $craftsmanships,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $inputs = $request->validated();

        $project = new Project;
        $project->fill($inputs);
        $project->craftman_id = $request->craftman_id ?? $user->craftman->id;
        $project->courses()->sync($request->courses ?? []);

        $project->save();

        return redirect()->route('backoffice.project.show', ['project' => $project->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): Response
    {
        return Inertia::render('BackOffice/Project/Show', [
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): Response
    {
        $user = Auth::user();
        if ($user->role == UserRole::Admin) {
            $craftmen = Craftman::query()->with('user')->get();
        }
        $courses = Course::query()
            ->when(
                Auth::user()->role !== UserRole::Admin->value,
                fn($query) => $query->where('craftman_id', optional(Auth::user()->craftman)->id)
            )
            ->when(
                Auth::user()->role === UserRole::Admin->value,
                fn($query) => $query->with('craftman.user')
            )
            ->get();

        return Inertia::render('BackOffice/Project/Edit', [
            'project' => $project->load('courses'),
            'courses' => $courses,
            'craftmen' => $craftmen,
            'craftsmanships' => Craftsmanship::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $project->title = $request->title;
        $project->description = $request->description;
        $project->duration = 0;
        $project->is_draft = $request->is_draft;
        $project->cost = $request->cost;
        $project->difficulty = $request->difficulty;

        $project->save();

        $project->courses()->sync($request->courses ?? []);

        return redirect()->route('backoffice.project.show', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('backoffice.project.index');
    }

    /**
     * Admin - Validate and publish a project
     */
    public function validateAndPublish(string $id): RedirectResponse
    {
        //
    }
}
