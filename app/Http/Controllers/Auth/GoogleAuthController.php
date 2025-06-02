<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect user to google authentication page
     */
    public function redirectToGoogle(Request $request): RedirectResponse
    {
        return Socialite::driver("google")->redirect();
    }

    /**
     * Handle google callback to login user
     */
    public function handleCallback(Request $request): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver("google")->user();

            if (!$googleUser) {
                return back()->with([
                    "toast" => [
                        "type" => "error",
                        "message" => __(
                            'Impossible de récupérer l\'utilisateur.'
                        ),
                    ],
                ]);
            }

            $user = User::where("google_id", $googleUser->getId())->first();
            if (is_null($user)) {
                $user = User::updateOrCreate(
                    ["email" => $googleUser->getEmail()],
                    [
                        "firstname" => $googleUser->user["given_name"],
                        "lastname" => $googleUser->user["family_name"],
                        "google_id" => $googleUser->getId(),
                    ]
                );
            }

            Auth::login($user);
        } catch (\Exception $e) {
            Log::error(
                "Erreur lors de la connexion Google : " . $e->getMessage()
            );

            return back()->with([
                "toast" => [
                    "type" => "error",
                    "message" => __(
                        'Une erreur est survenue lors de l\'authentification.'
                    ),
                ],
            ]);
        }

        return redirect()->route("home");
    }
}