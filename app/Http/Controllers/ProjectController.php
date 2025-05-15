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
            'transcription' => (function () {
                $path = storage_path('app/public/videos/transcription.txt');
                return is_file($path) ? trim(file_get_contents($path)) : null;
            })(),
        ]);
    }
}
