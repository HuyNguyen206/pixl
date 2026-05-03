<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    /** @use HasFactory<\Database\Factories\FollowFactory> */
    use HasFactory;

    public function followers()
    {
        return $this->belongsTo(Profile::class, 'follower_profile_id');
    }

    public function following()
    {
        return $this->belongsTo(Profile::class, 'following_profile_id');
    }
}
