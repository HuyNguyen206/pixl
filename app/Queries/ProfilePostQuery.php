<?php

namespace App\Queries;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfilePostQuery
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

    private function baseQuery(): HasMany
    {
        $viewerId = $this->currentProfile?->id ?? 0;

        return $this->profile->posts()
            ->withExists([
                'likeProfiles as is_like' => fn ($query) => $query->where('profiles.id', $viewerId),
                'replies as is_reply' => fn ($query) => $query->where('profile_id', $viewerId),
                'reposts as is_repost' => fn ($query) => $query->where('profile_id', $viewerId),
            ])
            ->whereNull('parent_id')
            ->with([
                'parentRepost' => fn ($query) => $query->withCount(['likes', 'replies', 'reposts']),
                'parentRepost.profile',
                'profile',
            ])
            ->withCount(['likes', 'replies', 'reposts'])
            ->latest();
    }
}
