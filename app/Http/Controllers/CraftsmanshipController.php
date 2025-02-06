<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Craft;

class CraftsmanshipController extends Controller
{
    public function show($slug)
    {
        $craft = Craft::findBySlugOrFail($slug);

        return Inertia::render('Craftmanship', [
            'craft' => [
                'slug'        => $craft->slug,
                'name'        => $craft->name,
                'description' => $craft->description,
            ],
        ]);
    }
}
