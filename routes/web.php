<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CraftsmanshipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
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
    ]);
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('projects/{project}')->name('projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'show'])->name('index');
        Route::get('courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    });

    Route::get('craftsmanships/{slug}', [CraftsmanshipController::class, 'show'])->name('craftsmanships.show');
    Route::get('skills/{course}', [SkillController::class, 'show'])->name('skills.show');

});

// ┌───────────────────────────────┐
// │ landing page api              │
// └───────────────────────────────┘

// Route::get('newsletter', [NewsletterController::class, 'index']);
