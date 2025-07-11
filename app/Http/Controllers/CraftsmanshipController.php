<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Craftsmanship;
use App\Models\Project;
use Inertia\Inertia;

class CraftsmanshipController extends Controller
{
    public function show(Craftsmanship $slug)
    {
        $skills = Course::query()
            ->isSkill()
            ->where('craftsmanship_id', $slug->id)
            ->inRandomOrder()
            ->take(2)
            ->get();

        $projects = Project::query()
            ->where('craftsmanship_id', $slug->id)
            ->with('craftman.user')
            ->inRandomOrder()
            ->paginate(6);

        return Inertia::render('Craftsmanship/Show', [
            'craftsmanship' => $slug,
            'projects' => $projects,
            'skills' => $skills,
        ]);
    }
}
