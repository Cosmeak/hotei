<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\LazyProp;

class ProjectController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Project $project): Response
    {
        $project->load('courses', 'craftman.user');

        return Inertia::render('Project/Show', [
            'project' => $project,
            'materials' => $project->courses->map(fn ($course) => $course->materials)->collapse(),
            'transcription' => Inertia::lazy(function () {
                $path = storage_path('app/courses_data/transcription.txt');

                if (file_exists($path)) {
                    return trim(file_get_contents($path));
                }

                return null;
            }),
        ]);
    }
}
