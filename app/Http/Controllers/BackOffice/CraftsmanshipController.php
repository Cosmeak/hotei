<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Craftsmanship;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CraftsmanshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $craftsmanships = Craftsmanship::query()->paginate(25)->withQueryString();

        return Inertia::render('BackOffice/Craftsmanship/Index', [
            'craftsmanships' => $craftsmanships,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $inputs = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:7'],
            'description' => ['required', 'string'],
        ]);


        $craftsmanship = new Craftsmanship($inputs);
        $craftsmanship->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Craftsmanship $craftsmanship): RedirectResponse
    {
        $inputs = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:7'],
            'description' => ['required', 'string'],
        ]);

        $craftsmanship->fill($inputs);
        $craftsmanship->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Craftsmanship $craftsmanship): RedirectResponse
    {
        $craftsmanship->delete();

        return redirect()->back();
    }
}
