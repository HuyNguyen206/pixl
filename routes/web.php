<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{profile:handle}', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profiles.show');
Route::get('/{profile:handle}/replies', [\App\Http\Controllers\ProfileController::class, 'replies'])->name('profiles.replies');
Route::scopeBindings()->group(function () {
    Route::get('/{profile:handle}/status/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
});


Route::middleware('auth')->group(function () {
    Route::post('posts', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
});
