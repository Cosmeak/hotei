<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class SettingController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Settings/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('settings.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update the user's subscription plan.
     */
    public function updateCraftoutBilling(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'craftout_subscription' => ['nullable', 'numeric', 'min:0'],
            'craftout_total' => ['nullable', 'numeric', 'min:0'],
        ]);

        $user = $request->user();

        if (isset($validated['craftout_subscription'])) {
            $user->craftout_subscription = $validated['craftout_subscription'];
        }

        if (isset($validated['craftout_total'])) {
            $user->craftout_total = $validated['craftout_total'];
        }

        $user->save();

        return Redirect::route('settings.edit')->with('status', 'craftout-updated');
    }


    /**
     * Update the user's total subscription value.
     */
    public function updateTotal(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'craftout_total' => ['required', 'numeric', 'min:0'],
        ]);

        $request->user()->update([
            'craftout_total' => $validated['craftout_total'],
        ]);

        return Redirect::route('settings.edit')->with('status', 'total-updated');
    }
}
