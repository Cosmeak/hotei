<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Course/Index');
    }

    /**
     * Display the specified resource.
     */
    public function show($courseId)
    {
        $course = Course::with(['craftman', 'project'])->findOrFail($courseId);

        return Inertia::render('Course/Show', [
            'course' => $course,
            'craftman' => $course->craftman,
            'project' => $course->project,
        ]);
    }
}
