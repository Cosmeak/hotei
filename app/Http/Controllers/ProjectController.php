<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Project/Index');
    }

    /**
     * Display the specified resource.
     */
    public function show($projectId): Response
    {
        $course = Course::with(['craftman', 'project'])->findOrFail($projectId);

        return Inertia::render('Project/Show', [
            'course' => $course,
            'craftman' => $course->craftman,
            'project' => $course->project,
        ]);
    }
}
