<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Craft;
use Illuminate\Http\Request;
use App\Models\Craftsmanship;

class CraftsmanshipController extends Controller
{
    public function show(Craftsmanship $craftsmanship)
    {
        return Inertia::render('Craftmanship', [
            'craftsmanship' => $craftsmanship,
        ]);
    }
}
