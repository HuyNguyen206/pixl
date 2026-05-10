<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    /** @use HasFactory<\Database\Factories\FollowFactory> */
    use HasFactory;

    public function follower()
    {
        return $this->belongsTo(Profile::class, 'follower_profile_id');
    }

    public function followed()
    {
        return $this->belongsTo(Profile::class, 'followed_profile_id');
    }

    public static function createFollow(Profile $follower, Profile $followeds)
    {
        if ($follower->id === $followeds->id) {
            throw new \InvalidArgumentException('A profile cannot follow itself.');
        }

        return static::firstOrCreate([
            'followed_profile_id' => $followeds->id,
            'follower_profile_id' => $follower->id,
        ]);
    }
}
