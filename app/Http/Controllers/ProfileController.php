<?php

namespace App\Http\Controllers;

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
                    'parentRepost' =>  fn($query) => $query->withCount(['likes', 'replies', 'reposts']),
                    'parentRepost.profile',
                    'profile'
                ])
            ->withCount(['likes', 'replies', 'reposts'])
            ->latest()
            ->get();

        return view('profile.show', compact('profile', 'posts'));
    }
}
