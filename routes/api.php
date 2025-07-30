<?php

use App\Http\Controllers\LemonWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/newsletter', [\App\Http\Controllers\NewsletterController::class, 'store']);
Route::post('/lemon-squeezy/webhook', [LemonWebhookController::class, 'handle']);
