<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CraftsmanshipController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

// ┌───────────────────────────────┐
// │ authentication                │
// └───────────────────────────────┘
require __DIR__ . "/web/auth.php";

// ┌───────────────────────────────┐
// │ back office                   │
// └───────────────────────────────┘
require __DIR__ . "/web//backoffice.php";

// ┌───────────────────────────────┐
// │ user interface                │
// └───────────────────────────────┘
Route::get("/", function () {
    return Inertia::render("Home");
})->name("home");

Route::middleware('auth')->group(function () {
    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update')->middleware([HandlePrecognitiveRequests::class]);
    Route::put('/settings/craftout', [SettingController::class, 'updateCraftoutBilling'])->name('craftout.update');
    Route::put('/settings/total', [SettingController::class, 'updateTotal'])->name('total.update');
    Route::delete('settings', [SettingController::class, 'destroy'])->name('settings.destroy');

    Route::prefix("projects/{project}")
        ->name("projects.")
        ->group(function () {
            Route::get("/", [ProjectController::class, "show"])->name("index");
            Route::get("courses/{course}", [
                CourseController::class,
                "show",
            ])->name("courses.show");
        });

    Route::get("craftsmanships/{slug}", [
        CraftsmanshipController::class,
        "show",
    ])->name("craftsmanships.show");
    Route::get("skills/{course}", [SkillController::class, "show"])->name(
        "skills.show"
    );
});

// ┌───────────────────────────────┐
// │ landing page api              │
// └───────────────────────────────┘

// Route::get('newsletter', [NewsletterController::class, 'index']);
