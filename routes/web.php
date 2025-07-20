<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CraftsmanshipController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

// ┌───────────────────────────────┐
// │ authentication                                     │
// └───────────────────────────────┘
require __DIR__.'/web/auth.php';

// ┌───────────────────────────────┐
// │ back office                                        │
// └───────────────────────────────┘
require __DIR__.'/web/backoffice.php';

// ┌───────────────────────────────┐
// │ user interface                                     │
// └───────────────────────────────┘
Route::get('/', HomeController::class)->name('home');

// Craftsmanships
Route::get('craftsmanships/{slug}', [CraftsmanshipController::class, 'show'])->name('craftsmanships.show');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Projects
    Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('projects/{project}/courses/{course}', [CourseController::class, 'show'])->name('projects.courses.show')->middleware(App\Http\Middleware\EnsureIsBuyed::class);

    // Skills
    Route::get('skills/{course}', [SkillController::class, 'show'])->name('skills.show')->middleware(App\Http\Middleware\EnsureIsBuyed::class);

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Comments
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store')->middleware(Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class);
});

// ┌───────────────────────────────┐
// │ landing page api                                   │
// └───────────────────────────────┘
// Route::get('newsletter', [NewsletterController::class, 'index']);
