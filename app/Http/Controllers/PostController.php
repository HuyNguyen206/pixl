<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\Profile;
use App\Queries\TimelineQuery;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $profile = auth()->user()->profile;
        $posts = Post::take(4)->get();
//        $posts = Post::where('profile_id', $profile->id)
//            ->orWhereIn('profile_id', function ($query) {
//                Follow::where('followed_profile_id', auth()->user()->profile->id)
//                    ->select('follower_profile_id');
////                $profile->followings()->pluck('profiles.id')
//            })->withCount(['likes', 'replies', 'reposts'])->latest()->get();

        $posts = TimelineQuery::forViewer($profile)->get();

        return view('posts.index', compact('posts', 'profile'));
    }

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
        $request->validate([
            'content' => 'nullable|string|max:1000'
        ]);

        $request->user()->profile->posts()->create([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.index');
    }

    public function storeReply(Profile $profile, Post $post, Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $post->replies()->create([
            'profile_id' => $profile->id,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.index');
    }

    public function storeRepost(Profile $profile, Post $post)
    {
        $post->reposts()->create([
            'profile_id' => $profile->id,
        ]);

        return redirect()->route('posts.index');
    }

    public function storeQuote(Profile $profile, Post $post, Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $post->reposts()->create([
            'profile_id' => $profile->id,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.index');
    }

    public function likeToggle(Profile $profile, Post $post)
    {
        $post->likeProfiles()->toggle($profile);

        return redirect()->route('posts.index');
    }
}
