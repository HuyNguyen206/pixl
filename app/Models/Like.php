<?php

namespace App\Models;

use Database\Factories\LikeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    /** @use HasFactory<LikeFactory> */
    use HasFactory;

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public static function createLike(Profile $profile, Post $post)
    {
        //        $post->likeProfiles()->attach($profile);
        //        return $post->likes()->latest('id')->first();

        return static::firstOrCreate([
            'post_id' => $post->id,
            'profile_id' => $profile->id,
        ]);
    }

    public static function removeLike(Profile $profile, Post $post)
    {
        return $post->likeProfiles()->detach($profile);
    }
}
