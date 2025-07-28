<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LemonWebhookController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
        try {
            // Pour loguer même si ça crash plus loin
            Log::info('Webhook reçu de Lemon Squeezy :');
            Log::info($request->all());

            // Parse le contenu JSON brut pour éviter problèmes
            $payload = json_decode($request->getContent(), true);

            if (! $payload) {
                Log::warning('Payload JSON invalide');

                return response()->json(['error' => 'Invalid JSON'], 400);
            }

            $event = $payload['meta']['event_name'] ?? 'unknown';

            Log::info('Événement reçu : '.$event);

            return response()->json(['status' => 'ok']);
        } catch (\Throwable $e) {
            Log::error('Erreur webhook Lemon Squeezy : '.$e->getMessage());

            return response()->json(['error' => 'Server Error'], 500);
        }
    }
}
