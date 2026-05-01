<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fn() => User::factory(),
            'display_name' => $this->faker->name(),
            'handle' => $this->faker->unique()->userName(),
            'bio' => $this->faker->sentences(),
            'avatar_url' => $this->faker->imageUrl(200, 200),
        ];
    }
}
