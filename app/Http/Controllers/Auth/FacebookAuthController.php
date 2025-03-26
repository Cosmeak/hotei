<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    /**
     * Redirect user to facebook authentication page
     */
    public function redirectToFacebook(Request $request): RedirectResponse
    {
        return Socialite::driver("facebook")->redirect();
    }

    /**
     * Handle facebook callback to login user
     */
    public function handleCallback(Request $request): RedirectResponse
    {
        try {
            $facebookUser = Socialite::driver("facebook")->user();

            if (!$facebookUser) {
                back()->with([
                    "toast" => [
                        "type" => "error",
                        "message" => __(
                            'Impossible de récupérer l\'utilisateur.'
                        ),
                    ],
                ]);
            }

            $user = User::where("facebook_id", $facebookUser->getId())->first();
            if (is_null($user)) {
                $user = User::updateOrCreate(
                    ["email" => $user->getEmail()],
                    [
                        "firstname" => $facebookUser->user["given_name"],
                        "lastname" => $facebookUser->user["family_name"],
                        "facebook_id" => $facebookUser->getId(),
                    ]
                );
            }

            Auth::login($user);
        } catch (\Exception $e) {
            Log::error(
                "Erreur lors de la connexion Facebook : " . $e->getMessage()
            );

            back()->with([
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
