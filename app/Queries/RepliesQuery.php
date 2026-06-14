<?php

namespace App\Queries;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class RepliesQuery
{
    public function __construct(private readonly Profile $profile, private readonly ?Profile $currentProfile = null) {}

    public static function for(Profile $profile, ?Profile $currentProfile = null)
    {
        return new self($profile, $currentProfile);
    }

    public function get()
    {
        return $this->baseQuery()->get();
    }

    public function paginate(int $perPage = 20): LengthAwarePaginator
    {
        return $this->baseQuery()->paginate($perPage);
    }

    private function baseQuery(): Builder
    {
        $viewerId = $this->currentProfile?->id ?? 0;

        return Post::query()
            ->where(fn ($query) => $query
                ->where('profile_id', $this->profile->id)
                ->whereNull('parent_id')
            )
            ->orWhereHas('replies', fn ($query) => $query
                ->whereBelongsTo($this->profile)
            )
            ->with([
                'parentRepost' => fn ($query) => $query
                    ->withCount(['likes', 'replies', 'reposts']),
                'parentRepost.profile',
                'parentPost.profile',
                'profile',
                'replies' => fn ($query) => $query
                    ->whereBelongsTo($this->profile)->with('profile')->latest()
                    ->withExists([
                        'likeProfiles as is_like' => fn ($query) => $query->where('profiles.id', $viewerId),
                        'replies as is_reply' => fn ($query) => $query->where('profile_id', $viewerId),
                        'reposts as is_repost' => fn ($query) => $query->where('profile_id', $viewerId),
                    ]),
            ])
            ->withExists([
                'likeProfiles as is_like' => fn ($query) => $query->where('profiles.id', $viewerId),
                'replies as is_reply' => fn ($query) => $query->where('profile_id', $viewerId),
                'reposts as is_repost' => fn ($query) => $query->where('profile_id', $viewerId),
            ])
            ->withCount(['likes', 'replies', 'reposts'])
            ->latest();
    }
}
