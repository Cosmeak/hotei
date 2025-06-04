<?php

namespace App\Http\Controllers;

use App\Models\Craftman;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $craftmen = Craftman::with('user')->limit(3)->get();

        return Inertia::render('Home/Index', [
            'craftmen' => $craftmen,
        ]);
    }
}
