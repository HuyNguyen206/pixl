<?php

namespace App\Queries;

use App\Models\Follow;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;

class PostThreadQuery
{
    public static function getFor(Post $post, ?Profile $profile = null)
    {
        $viewerId = $profile?->id ?? 0;
//        dd($post->profile);
        $post->load([
            'replies' => fn(HasMany $q) => $q
                ->withCount(['likes', 'replies', 'reposts'])
                ->withExists([
                    'likeProfiles as is_like' => fn($query) => $query->where('profiles.id', $viewerId),
                    'replies as is_reply' => fn($query) => $query->where('profile_id', $viewerId),
                    'reposts as is_repost' => fn($query) => $query->where('profile_id', $viewerId),
                ])
                ->with([
                    'profile',
                    'replies' => fn(HasMany $q) => $q
                        ->withCount(['likes', 'replies', 'reposts'])
                        ->withExists([
                            'likeProfiles as is_like' => fn($query) => $query->where('profiles.id', $viewerId),
                            'replies as is_reply' => fn($query) => $query->where('profile_id', $viewerId),
                            'reposts as is_repost' => fn($query) => $query->where('profile_id', $viewerId),
                        ])
                        ->with('profile')
                        ->oldest()
                ])
                ->oldest()
        ])
            ->loadCount(['likes', 'replies', 'reposts'])
            ->loadExists([
                'likeProfiles as is_like' => fn($query) => $query->where('profiles.id', $viewerId),
                'replies as is_reply' => fn($query) => $query->where('profile_id', $viewerId),
                'reposts as is_repost' => fn($query) => $query->where('profile_id', $viewerId),
            ]);
    }
}
