<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

//Route::get('/', fn () => \Inertia\Inertia::render('welcome', [
//    'greeting' => 'Hello World'
//]));
Route::redirect('/', '/home');

Route::middleware('auth')->group(function () {
    Route::get('home', [PostController::class, 'index'])->name('posts.index');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('{profile:handle}/follows/toggle', [ProfileController::class, 'followToggle'])->name('posts.follow-toggle');

    Route::scopeBindings()->group(function () {
        Route::post('{profile:handle}/{post}/replies', [PostController::class, 'storeReply'])->name('replies.store');
        Route::post('{profile:handle}/{post}/reposts', [PostController::class, 'storeRepost'])->name('posts.repost');
        Route::post('{profile:handle}/{post}/quotes', [PostController::class, 'storeQuote'])->name('posts.quote');
        Route::delete('{profile:handle}/{post}/quotes', [PostController::class, 'destroyQuote'])->name('posts.quote.delete');
        Route::post('{profile:handle}/{post}/likes/toggle', [PostController::class, 'likeToggle'])->name('posts.like-toggle');
    });
});

Route::get('/dev/login', function () {
    //   $user = \App\Models\User::query()->inRandomOrder()->first();
    $user = User::query()->find(1);

    Auth::login($user);
    request()->session()->regenerate();

//    return redirect()->intended(route('profiles.show', $user->profile));
    return redirect()->intended(route('posts.index'));
})->name('login');

Route::get('/dev/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->intended(route('feed'));
});

Route::get('/{profile:handle}', [ProfileController::class, 'show'])->name('profiles.show');
Route::get('/{profile:handle}/replies', [ProfileController::class, 'replies'])->name('profiles.replies');
Route::scopeBindings()->group(function () {
    Route::get('/{profile:handle}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});
