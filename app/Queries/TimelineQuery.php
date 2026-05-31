<?php

namespace App\Queries;

use App\Models\Follow;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class TimelineQuery
{
    public function __construct(private Profile $profile)
    {
    }

    public static function forViewer(Profile $profile): static
    {
        return new static($profile);
    }

    public function get()
    {
        $result = $this->baseQuery()->get();
//        dd($result);
        return $result;
    }

    public function paginate(int $perPage = 20): LengthAwarePaginator
    {
        return $this->baseQuery()->paginate($perPage);
    }

    private function baseQuery(): Builder
    {
        return Post::where(function ($query) {
            $query->where('profile_id', $this->profile->id);
            $query->orWhereIn('profile_id', function ($query) {
                    $query->select('follower_profile_id')->from((new Follow)->getTable())
                        ->where('followed_profile_id', $this->profile->id);
                });
        })
            ->whereNull('parent_id')
            ->with([
                'profile',
                'reposts' => fn($query) => $query
                    ->withCount([
                        'likes',
                        'replies',
                        'reposts'
                    ])
                    ->withExists([
                        'likeProfiles as is_like' => fn($query) => $query->where('profiles.id', $this->profile->id),
                        'replies as is_reply' => fn($query) => $query->where('profile_id', $this->profile->id),
                        'reposts as is_repost' => fn($query) => $query->where('profile_id', $this->profile->id),
                    ])
                    ->with('profile'),
            ])
            ->withCount([
                'likes',
                'replies',
                'reposts',
            ])
            ->withExists([
                'likeProfiles as is_like' => fn($query) => $query->where('profiles.id', $this->profile->id),
                'replies as is_reply' => fn($query) => $query->where('profile_id', $this->profile->id),
                'reposts as is_repost' => fn($query) => $query->where('profile_id', $this->profile->id),
            ])
            ->latest();
    }
}
