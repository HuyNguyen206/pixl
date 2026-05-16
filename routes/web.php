<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{profile:handle}', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profiles.show');

Route::get('/feed', function () {
    return view('feed');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::middleware('auth')->group(function () {
    Route::post('posts', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
});
