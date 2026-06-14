<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Queries\ProfilePostQuery;
use App\Queries\RepliesQuery;

class ProfileController extends Controller
{
    public function show(Profile $profile)
    {
        $profile->loadCount(['followers', 'followings']);

        $posts = ProfilePostQuery::for($profile, auth()->user()?->profile)->get();

        return view('profile.show', compact('profile', 'posts'));
    }

    public function replies(Profile $profile)
    {
        $profile->loadCount(['followers', 'followings']);
        $posts = RepliesQuery::for($profile, auth()->user()?->profile)->get();

        return view('profile.replies', compact('profile', 'posts'));
    }

    public function followToggle(Profile $profile)
    {
        $profile->followers()->toggle(auth()->user()->profile);

        return redirect()->back();
    }
}
