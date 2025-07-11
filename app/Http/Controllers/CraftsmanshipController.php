<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Project;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Craftsmanship;

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
            ->inRandomOrder()
            ->paginate(25);

        return Inertia::render('Craftsmanship/Show', [
            'craftsmanship' => $slug,
            'projects' => $projects,
            'skills' => $skills
        ]);
    }
}
