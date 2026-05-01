<?php

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
            $table->foreignIdFor(\App\Models\Profile::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Post::class, 'parent_id')->nullable()->constrained()->cascadeOnDelete();
            $table->text('content');
            $table->timestamps();

            $table->index(['parent_id']);
            $table->index(['profile_id', 'created_at']);
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
