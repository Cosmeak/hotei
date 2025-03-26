<?php

namespace App\Http\Controllers;

use App\Models\Craft;
use Inertia\Inertia;

class CraftsmanshipController extends Controller
{
    public function show($slug)
    {
        $craft = Craft::findBySlugOrFail($slug);

        return Inertia::render('Craftmanship', [
            'craft' => [
                'slug' => $craft->slug,
                'name' => $craft->name,
                'description' => $craft->description,
            ],
        ]);
    }
}
