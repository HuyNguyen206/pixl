<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Queries\ProfilePostQuery;
use App\Queries\RepliesQuery;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show(Profile $profile)
    {
        $profile->loadCount(['followers', 'followings']);
        $profile->loadExists([
            'followers as is_follow' => fn (Builder $query) => $query->where('follows.follower_profile_id', auth()->user()?->profile->id)
        ]);

        $posts = ProfilePostQuery::for($profile, auth()->user()?->profile)->get();

        return Inertia::render('Profile/Show', compact('posts', 'profile'));
    }

    public function replies(Profile $profile)
    {
        $profile->loadCount(['followers', 'followings']);
        $posts = RepliesQuery::for($profile, auth()->user()?->profile)->get();

        return Inertia::render('Profile/Show', compact('posts', 'profile'));
    }

    public function followToggle(Profile $profile)
    {
        $profile->followers()->toggle(auth()->user()->profile);

        return redirect()->back();
    }
}
