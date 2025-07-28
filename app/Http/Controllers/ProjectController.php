<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Project $project): Response
    {
        $user = Auth::user();
        $project->load(['craftman.user']);
        $skills = $project->courses()->isSkill()->with('craftman.user')->get();
        $courses = $project->courses()->isSkill(false)->get();

        $completed = $user?->completedCourses()->whereIn('course_id', $courses->pluck('id')->concat($skills->pluck('id')))->get() ?? collect([]);
        $possessed = collect([]); // TODO: need order table to be operationnal

        $skills = $skills->map(function ($skill) use ($completed, $possessed) {
            $skill->is_completed = $completed->contains('id', $skill->id);
            $skill->is_possessed = $possessed->contains('id', $skill->id);

            return $skill;
        });

        $courses = $courses->map(function ($course) use ($completed, $possessed) {
            $course->is_completed = $completed->contains('id', $course->id);
            $course->is_possessed = $possessed->contains('id', $course->id);

            return $course;
        });

        $percentageCompleted = $courses->reduce(fn (?int $acc, Course $course) => $acc + $course->is_completed) / $courses->count() * 100;

        // TODO: validate already completed courses (add is_completed to all courses -> default to false - cast in model?)
        // TODO: add is_possessed to courses -> default to false - cast in model?

        return Inertia::render('Project/Show', [
            'courses' => $courses,
            'materials' => $courses->map(fn ($course) => $course->materials)->collapse(),
            'percentageCompleted' => $percentageCompleted,
            'project' => $project,
            'skills' => $skills,
        ]);
    }
}
