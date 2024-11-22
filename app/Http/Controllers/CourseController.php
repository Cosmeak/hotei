<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    /**
     * Display a course
     */
    public function show(): Response
    {
        return Inertia::render('Course/Index', []);
    }
}
