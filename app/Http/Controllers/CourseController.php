<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Project;
use App\Supports\CommentsTree;
use Illuminate\Http\RedirectResponse;
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

        $course->load('craftman.user', 'skills', 'comments.user');
        $skills = $course->skills;
        unset($course->skills);

        $comments = CommentsTree::generate($course->comments->toArray());

        return Inertia::render('Course/Show', [
            'project' => $project,
            'comments' => $comments,
            'course' => $course,
            'skills' => $skills,
        ]);
    }
}
