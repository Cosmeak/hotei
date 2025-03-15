<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Illuminate\Support\Facades\Auth;

// class GoogleAuthController extends Controller
// {
//     public function handleGoogleLogin(Request $request)
//     {
//         $token = $request->input('token');

//         if (!$token) {
//             return response()->json(['error' => 'Token manquant'], 400);
//         }

//         // Vérifier le token avec Google
//         $client = new \Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
//         $payload = $client->verifyIdToken($token);

//         if (!$payload) {
//             return response()->json(['error' => 'Token invalide'], 401);
//         }

//         // Récupérer les infos de l'utilisateur depuis le token JWT
//         $googleId = $payload['sub'];
//         $email = $payload['email'];
//         $name = $payload['name'];
//         $avatar = $payload['picture'];

//         // Vérifier si l'utilisateur existe déjà
//         $user = User::where('google_id', $googleId)->orWhere('email', $email)->first();

//         if (!$user) {
//             // Créer un nouvel utilisateur
//             $user = User::create([
//                 'name' => $name,
//                 'email' => $email,
//                 'google_id' => $googleId,
//                 'avatar' => $avatar,
//                 'password' => bcrypt(uniqid()) // Génère un mot de passe aléatoire
//             ]);
//         }

//         // Connecter l'utilisateur
//         Auth::login($user);

//         return response()->json([
//             'message' => 'Connexion réussie',
//             'user' => $user
//         ]);
//     }
// };

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest; 
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Log; 

class GoogleAuthController extends Controller
{
    public function handleGoogleLogin(HttpRequest $request)
{
    $token = $request->input('token');

    if (!$token) {
        Log::error("Token manquant");
        return response()->json(['error' => 'Token manquant'], 400);
    }

    try {
        Log::info("Token reçu : " . $token);

        $googleUser = Socialite::driver('google')->stateless()->userFromToken($token);

        if (!$googleUser) {
            Log::error("Échec de récupération des infos Google");
            return response()->json(['error' => 'Impossible de récupérer les informations utilisateur Google'], 500);
        }

        Log::info("Utilisateur Google : " . json_encode($googleUser));

        Log::info("Google ID : " . $googleUser->getId());
        Log::info("Email : " . $googleUser->getEmail());

        $user = User::updateOrCreate(
            ['google_id' => $googleUser->getId()],
            [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
            ]
        );

        Log::info("Utilisateur enregistré ou mis à jour : " . $user->id);

        Auth::login($user);
        Log::info("Utilisateur connecté : " . $user->id);

        return response()->json([
            'message' => 'Connexion réussie',
            'user' => $user
        ]);
    } catch (\Exception $e) {
        Log::error("Erreur lors de la connexion Google : " . $e->getMessage());
        return response()->json(['error' => 'Erreur Google: ' . $e->getMessage()], 500);
    }
}

}