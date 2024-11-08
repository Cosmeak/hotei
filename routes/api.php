<?php

use Illuminate\Support\Facades\Route;

Route::post('/newsletter', [\App\Http\Controllers\NewsletterController::class, 'store']);
