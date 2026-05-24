<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Profile $profile, Post $post)
    {
        $post->load([
            'replies' => fn(HasMany $q) => $q
                ->withCount(['likes', 'replies', 'reposts'])
                ->with([
                    'profile',
                    'replies' => fn(HasMany $q) => $q
                        ->withCount(['likes', 'replies', 'reposts'])
                        ->with('profile')
                        ->oldest()
                ])
                ->oldest()
        ])->loadCount(['likes', 'replies', 'reposts']);

        return view('posts.show', compact('post'));
    }
    public function store(Request $request)
    {
//        dd(123);
        $request->user()->profile->posts()->create([
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }
}
