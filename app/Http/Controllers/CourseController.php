<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Project $project, Course $course): Response|RedirectResponse
    {
        if ($course->is_skill) {
            return back();
        }

        $course->load('craftman.user', 'skills');

        $course->materials = $this->prepareMaterials($course);

        $user = Auth::user();
        $completedCourses = $user->load(['completedCourses' => function ($query) use ($project) {
            $query->whereIn('course_id', $project->courses->pluck('id'));
        }]);

        $completion = $completedCourses->count() / $project->courses->count();

        return Inertia::render('Course/Show', [
            'project' => $project,
            'course' => $course,
            'completion' => $completion,
        ]);
    }

    /**
     * Prepare materials
     */
    private function prepareMaterials(Course $course): \Illuminate\Support\Collection
    {
        return collect($course->materials)->map(function ($material, $index) {
            return [
                'id' => $index + 1,
                'image' => "/images/materials/{$material}.jpg",
                'quantity' => rand(1, 5),
                'content' => ucfirst($material),
                'url' => "https://example.com/materials/{$material}",
            ];
        });
    }
}
