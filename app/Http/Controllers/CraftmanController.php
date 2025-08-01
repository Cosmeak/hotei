<?php

namespace App\Http\Controllers;

use App\Enums\Difficulty;
use App\Models\Course;
use App\Models\Craftman;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CraftmanController extends Controller
{
    public function show(Request $request, Craftman $craftman): Response
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $search = $request->input('search');
        $difficulties = array_filter(explode(',', $request->input('difficulties', '')));

        $craftman->load([
            'user',

            'courses' => function ($query) {
                $query->isSkill();
            },
        ]);

        $projects = Project::query()
            ->where('craftman_id', $craftman->id)
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
            ->paginate(6)
            ->withQueryString();

        $courses = Course::query()
            ->where('craftman_id', $craftman->id)
            ->isSkill()
            ->paginate(6)
            ->withQueryString();

        return Inertia::render('Craftman/Show', [
            'craftman' => $craftman,
            'projects' => $projects,
            'courses' => $courses,
            'filters' => array_merge($request->query(), ['difficulties' => $difficulties]),
            'availableDifficulties' => Difficulty::toArray(),
        ]);
    }
}
