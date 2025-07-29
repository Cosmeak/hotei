<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Craftsmanship;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CraftsmanshipController extends Controller
{
    public function show(Request $request, Craftsmanship $slug)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $difficulties = array_filter(explode(',', $request->input('difficulties', '')));

        $projects = Project::query()
            ->where('craftsmanship_id', $slug->id)
            ->when(! is_null($minPrice) && ! is_null($maxPrice), function ($q) use ($minPrice, $maxPrice, $difficulties) {
                $q->whereBetween('cost', [$minPrice, $maxPrice]);
            })
            ->when(! empty($difficulties), function ($q) use ($difficulties) {
                $q->whereIn('difficulty', $difficulties);
            })
            ->with(['craftman.user'])
            ->paginate(6)
            ->withQueryString();

        $skills = Course::query()
            ->isSkill()
            ->where('craftsmanship_id', $slug->id)
            ->inRandomOrder()
            ->take(2)
            ->get();

        return Inertia::render('Craftsmanship/Show', [
            'craftsmanship' => $slug,
            'projects' => $projects,
            'skills' => $skills,
            'filters' => [
                'difficulties' => $difficulties,
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
            ],
        ]);
    }
}
