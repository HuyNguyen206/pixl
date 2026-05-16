<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    public function profile(): BelongsTo
    {
        return $this->BelongsTo(Profile::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function parentPost(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function parentRepost(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'repost_of_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function reposts(): HasMany
    {
        return $this->hasMany(Post::class, 'repost_of_id');
    }

    public function likeProfiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class, 'likes', 'post_id', 'profile_id')->withTimestamps();
    }

    public static function publish(Profile $profile, string $content)
    {
        return static::create([
            'profile_id' => $profile->id,
            'content' => $content,
        ]);
    }

    public static function replyToPost(Post $post, Profile $replier, string $message): static
    {
        return $post->replies()->create([
            'profile_id' => $replier->id,
            'content' => $message,
        ]);
    }

    public static function repostOfPost(Post $post, Profile $reposter, string $message = null)
    {
        return $post->reposts()->firstOrCreate([
            'profile_id' => $reposter->id,
        ], ['content' => $message]);
    }

    public static function removeRepostOfPost(self $post, Profile $reposter)
    {
        return Post::where('repost_of_id', $post->id)
            ->where('profile_id', $reposter->id)
            ->delete();
    }
}
