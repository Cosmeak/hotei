<?php

namespace App\Http\Controllers;

use App\Enums\Difficulty;
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
        $search = $request->input('search');
        $difficulties = array_filter(explode(',', $request->input('difficulties', '')));

        $projects = Project::query()
            ->where('craftsmanship_id', $slug->id)
            ->when(! is_null($minPrice) && ! is_null($maxPrice), function ($q) use ($minPrice, $maxPrice) {
                $q->whereBetween('cost', [$minPrice, $maxPrice]);
            })
            ->when(! empty($difficulties), function ($q) use ($difficulties) {
                $q->whereIn('difficulty', $difficulties);
            })
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->with(['craftman.user'])
            ->orderByDesc('cost')
            ->paginate(6)
            ->withQueryString();

        $user = $request->user();
        $projects->getCollection()->transform(function ($project) use ($user) {
            $project->purchased = $user ? $user->orders()
                ->where('project_id', $project->id)
                ->exists() : false;

            return $project;
        });

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
            'availableDifficulties' => Difficulty::toArray(),
            'filters' => [
                'search' => $request->input('search', ''),
                'difficulties' => array_values($difficulties),
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
            ],
        ]);
    }
}
