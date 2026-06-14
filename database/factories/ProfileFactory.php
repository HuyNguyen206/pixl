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
            'user_id' => fn () => User::factory(),
            'display_name' => $this->faker->name(),
            'handle' => $handle = $this->faker->unique()->userName(),
            'bio' => $this->faker->sentence(),
            'avatar_url' => 'https://dummyimage.com/98x90/eee/000',
            'cover_url' => 'https://dummyimage.com/1400x640/555/ECA749?text='.$handle,
        ];
    }
}
