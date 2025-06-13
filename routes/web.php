<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CraftsmanshipController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

// ┌───────────────────────────────┐
// │ authentication                │
// └───────────────────────────────┘
require __DIR__.'/web/auth.php';

// ┌───────────────────────────────┐
// │ back office                   │
// └───────────────────────────────┘
require __DIR__.'/web/backoffice.php';

// ┌───────────────────────────────┐
// │ user interface                │
// └───────────────────────────────┘
Route::get('/', HomeController::class)->name('home');

Route::get('craftsmanships/{slug}', [CraftsmanshipController::class, 'show'])->name('craftsmanships.show');

Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('projects/{project}/courses/{course}', [CourseController::class, 'show'])->name('projects.courses.show')->middleware('auth');

Route::get('skills/{course}', [SkillController::class, 'show'])->name('skills.show');

Route::middleware('auth')->resource('profile', ProfileController::class)
    ->only(['edit', 'update', 'destroy'])
    ->parameters(['profile' => ''])
    ->names('profile');

// ┌───────────────────────────────┐
// │ landing page api              │
// └───────────────────────────────┘

// Route::get('newsletter', [NewsletterController::class, 'index']);
