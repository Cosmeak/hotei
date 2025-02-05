<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Course/Index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course): \Inertia\Response
    {
        return Inertia::render('Course/Show', [
            'course' => $course,
        ]);
    }
}
