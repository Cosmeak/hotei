<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsBuyed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        dd($request->all());
        $user = Auth::user();
        $isBuyed = $user->orders()
            ->exists();

        // Redirect back user if it has not buyed the projet or course
        // and if it's not a admin
        if (! $isBuyed && $user->role != UserRole::Admin) {
            return back()->with([
                'toast' => [
                    'type' => 'error',
                    'message' => 'Vous n\'avez pas accès à cette ressource.',
                ],
            ]);
        }

        return $next($request);
    }
}
