<?php

namespace App\Http\Controllers;

use App\Enums\Category;
use App\Http\Requests\CourseRequest;
use App\Jobs\VideoOptimization;
use App\Models\Course;
use App\Models\Craftman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CourseBackOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $user = Auth::user();
        $courses = Course::query()
            ->when($user->role != 'admin', function ($query) use ($user) {
                $query->where('craftman_id', $user->craftman_id);
            })->paginate(100);

        return Inertia::render('Course/BackOffice/Index', [
            'courses' => $courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $user = Auth::user();
        $craftmen = collect();
        if ($user->role == 'admin') {
            $craftmen = Craftman::query()->with('user')->get();
        }
        $categories = Category::cases();

        return Inertia::render('Course/BackOffice/Create', [
            'craftmen' => $craftmen,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $course = new Course;
        $course->craftman_id = $request->craftman_id ?? $user->craftman->id;
        $course->title = $request->title;
        $course->description = $request->description;
        $course->duration = 0;
        $course->category = $request->category;
        $course->materials = $request->materials;
        $course->is_draft = $request->is_draft;
        $course->cost = $request->cost;
        $course->difficulty = $request->difficulty;
        $course->save();

        $video = $request->file('video');
        VideoOptimization::dispatch($video, 'courses/'.$course->id);

        return redirect()->route('backoffice.course.show', ['course' => $course->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course): Response
    {
        return Inertia::render('Course/Backoffice/Show', [
            'course' => $course,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course): Response
    {
        $user = Auth::user();
        $craftmen = collect();
        if ($user->role == 'admin') {
            $craftmen = Craftman::query()->with('user')->get();
        }
        $categories = Category::cases();

        return Inertia::render('Course/BackOffice/Edit', [
            'course' => $course,
            'craftmen' => $craftmen,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course): RedirectResponse
    {
        $course->title = $request->title;
        $course->description = $request->description;
        $course->duration = 0;
        $course->category = $request->category;
        $course->materials = $request->materials;
        $course->is_draft = $request->is_draft;
        $course->cost = $request->cost;
        $course->difficulty = $request->difficulty;
        $course->save();

        return redirect()->route('backoffice.course.show', ['course' => $course->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return redirect()->route('backoffice.course.index');
    }
}
