<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    /** @use HasFactory<\Database\Factories\LikeFactory> */
    use HasFactory;

    public function profile(): BelongsTo
    {
        $this->belongsTo(Profile::class);
    }

    public function post(): BelongsTo
    {
        $this->belongsTo(Post::class);
    }
}
