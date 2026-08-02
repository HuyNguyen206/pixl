<?php

namespace App\Models;

use Database\Factories\ProfileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    /** @use HasFactory<ProfileFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function parentPosts(): HasMany
    {
        return $this->hasMany(Post::class)->whereNull('parent_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * The profiles that follow this profile.
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            Profile::class,
            'follows',
            'followed_profile_id',
            'follower_profile_id'
        )->withTimestamps();
    }

    /**
     * The profiles that this profile follows
     */
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(
            Profile::class,
            'follows',
            'follower_profile_id',
            'followed_profile_id'
        )->withTimestamps();
    }

    public static function createFollow(Profile $follower, Profile $following) {}

    public function follow(Profile $followedProfile)
    {
        Follow::createFollow($this, $followedProfile);
    }
}
