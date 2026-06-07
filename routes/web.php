<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('home', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
    Route::post('posts', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');

    Route::scopeBindings()->group(function () {
        Route::post('{profile:handle}/{post}/replies', [\App\Http\Controllers\PostController::class, 'storeReply'])->name('replies.store');
    });
});

Route::get('feed', function () {
    return view('welcome');
})->name('feed');

Route::get('/dev/login', function () {
   $user = \App\Models\User::query()->inRandomOrder()->first();
   $user = \App\Models\User::query()->find(452);

   Auth::login($user);
   request()->session()->regenerate();

   return redirect()->intended(route('profiles.show', $user->profile));
});

Route::get('/dev/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->intended(route('feed'));
});

Route::get('/{profile:handle}', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profiles.show');
Route::get('/{profile:handle}/replies', [\App\Http\Controllers\ProfileController::class, 'replies'])->name('profiles.replies');
Route::scopeBindings()->group(function () {
    Route::get('/{profile:handle}/status/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
});


