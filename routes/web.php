<?php

use App\Http\Middleware\HasAccessBackOffice;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ┌───────────────────────────────┐
// │ authentication                │
// └───────────────────────────────┘
require __DIR__.'/auth.php';

// ┌───────────────────────────────┐
// │ user interface                │
// └───────────────────────────────┘
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('course', \App\Http\Controllers\CourseController::class)->only(['index', 'show']);

// ┌───────────────────────────────┐
// │ back office                   │
// └───────────────────────────────┘
Route::name('backoffice.')->prefix('backoffice')
    ->middleware(['auth', 'verified', HasAccessBackOffice::class, HandlePrecognitiveRequests::class])
    ->group(function () {
        Route::get('dashboard', function () {
            return Inertia::render('Dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        Route::resource('course', \App\Http\Controllers\CourseBackOfficeController::class);
    });

// ┌───────────────────────────────┐
// │ landing page api              │
// └───────────────────────────────┘
Route::get('newsletter', [\App\Http\Controllers\NewsletterController::class, 'index']);


// ┌───────────────────────────────┐
// │ home for a craft             │
// └───────────────────────────────┘
Route::get('/craft/{slug}', [\App\Http\Controllers\CraftsmanshipController::class, 'show'])
    ->name('craft.show');