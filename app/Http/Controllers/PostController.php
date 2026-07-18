<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\Profile;
use App\Queries\PostThreadQuery;
use App\Queries\TimelineQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $profile = auth()->user()->profile;
//        $posts = Post::take(4)->get();
        //        $posts = Post::where('profile_id', $profile->id)
        //            ->orWhereIn('profile_id', function ($query) {
        //                Follow::where('followed_profile_id', auth()->user()->profile->id)
        //                    ->select('follower_profile_id');
        // //                $profile->followings()->pluck('profiles.id')
        //            })->withCount(['likes', 'replies', 'reposts'])->latest()->get();

        $posts = TimelineQuery::forViewer($profile)->get()->toResourceCollection();
//        dd($posts);
        $profile = $profile->toResource();
//    dd($posts);
        return Inertia::render('Posts/Index', compact('posts', 'profile'));
        //        return view('posts.index', compact('posts', 'profile'));
    }

    public function show(Profile $profile, Post $post)
    {
        PostThreadQuery::getFor($post, \Auth::user()?->profile);

        return Inertia::render('Posts/Show', compact('post'));
    }

    public function store(Request $request)
    {
        //        dd(123);
        $data = $request->validate([
            'content' => 'nullable|string|min:3|max:1000',
        ]);

        $request->user()->profile->posts()->create([
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }

    public function storeReply(Profile $profile, Post $post, Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post->replies()->create([
            'profile_id' => $request->user()->profile->id,
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }

    public function storeRepost(Profile $profile, Post $post)
    {
        $post->reposts()->create([
            'profile_id' => request()->user()->profile->id,
        ]);

        return redirect()->back();
    }

    public function storeQuote(Profile $profile, Post $post, Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post->reposts()->create([
            'profile_id' => request()->user()->profile->id,
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }

    public function likeToggle(Profile $profile, Post $post)
    {
        $post->likeProfiles()->toggle($profile);

        return redirect()->back();
    }

    public function destroyQuote(Profile $profile, Post $post)
    {
        $currentProfile = auth()->user()->profile;

        if (\Auth::user()->can('delete', $post)) {
            $post->delete();

            return redirect()->back();
        }

        $repost = $post->reposts()->where('profile_id', $currentProfile->id)->first();

        if ($repost) {
            $repost->delete();

            return redirect()->back();
        }

        return redirect()->back();
    }

    public function destroy(Profile $profile, Post $post)
    {
        if (!\Auth::user()->can('delete', $post)) {
            abort(403, 'You are not authorized to delete this post.');
        }

        $post->delete();

        return redirect()->back();
    }
}
