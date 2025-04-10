<?php

use Inertia\Inertia;
use App\Models\Craftman;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CraftsmanshipController;

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
    $craftmen = Craftman::with('user')->limit(3)->get();
    return Inertia::render('Home', [
        'craftmen' => $craftmen
    ]);
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::patch('profile', [ProfileController::class, 'update'])->name(
        'profile.update'
    );
    Route::delete('profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy'
    );

    Route::prefix('projects/{project}')
        ->name('projects.')
        ->group(function () {
            Route::get('/', [ProjectController::class, 'show'])->name('index');
            Route::get('courses/{course}', [
                CourseController::class,
                'show',
            ])->name('courses.show');
        });

    Route::get('craftsmanships/{slug}', [
        CraftsmanshipController::class,
        'show',
    ])->name('craftsmanships.show');
    Route::get('skills/{course}', [SkillController::class, 'show'])->name(
        'skills.show'
    );
});

// ┌───────────────────────────────┐
// │ landing page api              │
// └───────────────────────────────┘

// Route::get('newsletter', [NewsletterController::class, 'index']);
