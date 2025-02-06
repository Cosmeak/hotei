<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ┌───────────────────────────────┐
// │ authentication                │
// └───────────────────────────────┘
require __DIR__.'/auth.php';

// ┌───────────────────────────────┐
// │ back office                   │
// └───────────────────────────────┘
require __DIR__.'/backoffice.php';

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
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('projects', \App\Http\Controllers\ProjectController::class)->only(['index', 'show']);
    Route::prefix('projects/{project}')->name('projects.')->group(function () {
        Route::resource('course', \App\Http\Controllers\CourseController::class)->only(['show']);
    });
  
    Route::get('/craft/{slug}', [\App\Http\Controllers\CraftsmanshipController::class, 'show'])
      ->name('craft.show');
});




// ┌───────────────────────────────┐
// │ landing page api              │
// └───────────────────────────────┘
Route::get('newsletter', [\App\Http\Controllers\NewsletterController::class, 'index']);

