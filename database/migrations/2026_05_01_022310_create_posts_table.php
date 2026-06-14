<?php

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Profile::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Post::class, 'parent_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Post::class, 'repost_of_id')->nullable()->constrained()->cascadeOnDelete();
            $table->text('content')->nullable();
            $table->timestamps();

            $table->index(['parent_id']);
            $table->index(['profile_id', 'created_at']);
            $table->unique(['profile_id', 'repost_of_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
