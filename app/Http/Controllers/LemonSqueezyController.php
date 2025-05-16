<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LemonSqueezyService;

class LemonSqueezyController extends Controller
{
    public function __construct(
        protected LemonSqueezyService $lemonSqueezyService
    ) {}

    public function createCheckout(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'email' => 'required|email',
        ]);

        $checkout = $this->lemonSqueezyService->createCheckout(
            $request->product_id,
            $request->email
        );

        return response()->json($checkout);
    }
}
