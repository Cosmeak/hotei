<?php

use App\Http\Middleware\HasAccessBackOffice;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

Route::name('backoffice.')->prefix('bo')
    ->middleware(['auth', 'verified', HasAccessBackOffice::class, HandlePrecognitiveRequests::class])
    ->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\BackOffice\BackOfficeController::class, 'dashboard'])->name('dashboard');
        Route::resource('course', \App\Http\Controllers\BackOffice\CourseController::class);
        Route::resource('project', \App\Http\Controllers\BackOffice\ProjectController::class);

        Route::middleware(\App\Http\Middleware\EnsureUserIsAdmin::class)->group(function () {
            Route::resource('user', \App\Http\Controllers\BackOffice\UserController::class)->except(['create', 'edit']);
            Route::post('course/validate-and-publish', [\App\Http\Controllers\BackOffice\CourseController::class, 'validateAndPublish'])->name('course.validate-and-publish');
            Route::post('project/validate-and-publish', [\App\Http\Controllers\BackOffice\ProjectController::class, 'validateAndPublish'])->name('project.validate-and-publish');
        });
    });
