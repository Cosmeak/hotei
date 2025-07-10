<?php

namespace App\Http\Controllers\BackOffice;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
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
            ->when(
                $user->role != UserRole::Admin->value,
                fn ($query) => $query->where('craftman_id', $user->craftman_id)
            )
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
        return Inertia::render('BackOffice/Project/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }

    /**
     * Admin - Validate and publish a project
     */
    public function validateAndPublish(string $id): RedirectResponse
    {
        //
    }
}
