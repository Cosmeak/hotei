<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Project $project): Response
    {
        $project->load(['craftman.user']);
        $skills = $project->courses()->isSkill()->with('craftman.user')->get();
        $courses = $project->courses()->isSkill(false)->get();

        // TODO: validate already completed courses (add is_completed to all courses -> default to false - cast in model?)

        return Inertia::render('Project/Show', [
            'courses' => $courses,
            'materials' => $courses->map(fn ($course) => $course->materials)->collapse(),
            'project' => $project,
            'skills' => $skills,
        ]);
    }
}
