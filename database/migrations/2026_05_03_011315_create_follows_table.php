<?php

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
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Profile::class, 'followed_profile_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Profile::class, 'follower_profile_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['followed_profile_id', 'follower_profile_id']);
            $table->index(['followed_profile_id']);
            $table->index(['follower_profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
