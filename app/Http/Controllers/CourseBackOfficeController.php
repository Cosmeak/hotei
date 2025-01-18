<?php

namespace App\Http\Controllers;

use App\Helpers\Video;
use App\Http\Requests\CourseRequest;
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
                $query->where('craftman_id', $user->id);
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

        return Inertia::render('Course/BackOffice/Create', [
            'craftmen' => $craftmen,
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
        Video::optimize($video, 'course/'.$course->id);

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
        return Inertia::render('Course/BackOffice/Edit', [
            'course' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course): RedirectResponse
    {
        $course->softDelete();

        return redirect()->route('backoffice.course.index');
    }
}
