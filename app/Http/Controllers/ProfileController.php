<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Profile $profile)
    {
        $profile->loadCount(['followers', 'followings']);

        $posts = $profile->posts()
            ->whereNull('parent_id')
            ->with([
                'parentRepost' => fn($query) => $query->withCount(['likes', 'replies', 'reposts']),
                'parentRepost.profile',
                'profile'
            ])
            ->withCount(['likes', 'replies', 'reposts'])
            ->latest()
            ->get();

        return view('profile.show', compact('profile', 'posts'));
    }

    public function replies(Profile $profile)
    {
        $profile->loadCount(['followers', 'followings']);

        $posts = Post::query()
            ->where(fn($query) => $query
                ->where('profile_id', $profile->id)
                ->whereNull('parent_id')
            )
            ->orWhereHas('replies', fn($query) => $query
                ->whereBelongsTo($profile)
            )
            ->with([
                'parentRepost' => fn($query) => $query
                    ->withCount(['likes', 'replies', 'reposts']),
                'parentRepost.profile',
                'parentPost.profile',
                'profile',
                'replies' => fn($query) => $query
                    ->whereBelongsTo($profile)->with('profile')->latest(),
            ])
            ->withCount(['likes', 'replies', 'reposts'])
            ->latest()
            ->get();

        return view('profile.replies', compact('profile', 'posts'));
    }
}
