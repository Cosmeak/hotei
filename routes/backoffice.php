<?php

use App\Http\Middleware\HasAccessBackOffice;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

Route::name('backoffice.')->prefix('backoffice')
    ->middleware(['auth', 'verified', HasAccessBackOffice::class, HandlePrecognitiveRequests::class])
    ->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\BackOffice\BackOfficeController::class, 'dashboard'])->name('dashboard');
        Route::resource('course', \App\Http\Controllers\BackOffice\CourseController::class);
    });
