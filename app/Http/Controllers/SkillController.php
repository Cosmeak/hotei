<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class SkillController extends Controller
{
    /**
     * Display a skill course
     */
    public function show(Course $course): Response|RedirectResponse
    {
        if (! $course->is_skill) {
            return redirect()->route('home');
        }

        $course->load('craftman.user');

        return Inertia::render('Courses/Show', [
            'course' => $course,
        ]);
    }
}
