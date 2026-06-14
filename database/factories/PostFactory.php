<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null,
            'repost_of_id' => null,
            'profile_id' => fn () => Profile::factory(),
            'content' => $this->faker->realText(200),
        ];
    }

    public function replyToParent(Post $parentPost)
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => $parentPost->id,
            'content' => $this->faker->realText(200),
        ]);
    }

    public function repostOf(Post $originalPost)
    {
        return $this->state(fn (array $attributes) => [
            'repost_of_id' => $originalPost->id,
            'content' => null,
        ]);
    }

    public function quotePost(Post $originalPost)
    {
        return $this->state(fn (array $attributes) => [
            'repost_of_id' => $originalPost->id,
            'content' => $this->faker->realText(200),
        ]);
    }
}
