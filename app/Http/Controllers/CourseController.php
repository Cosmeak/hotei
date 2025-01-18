<?php

namespace App\Http\Controllers;

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
    public function show(Course $course)
    {
        return Inertia::render('Course/Index', [
            'course' => $course,
        ]);
    }
}
