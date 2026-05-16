<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $profiles = Profile::factory(rand(5, 10))->create();

       $profiles->each(function ($profile) {
          $profile->posts()->createMany(
              Post::factory()->count(rand(2, 5))->make()->toArray()
          );
       });

       Post::get()->each(function (Post $post) {
            $post->replies()->createMany(
                Post::factory()->count(rand(2, 5))->make()->toArray()
            );

            $post->reposts()->createMany(
               Post::factory()->count(rand(2, 5))->make()->toArray()
            );

            $post->likeProfiles()->attach(
               Profile::factory()->count(rand(2, 5))->create()->pluck('id')
            );
       });

       Profile::get()->each(function (Profile $profile) {
          $profile->followings()->attach(
              $profile->factory()->count(rand(2, 5))->create()->pluck('id')
          );

           $profile->followers()->attach(
               $profile->factory()->count(rand(2, 5))->create()->pluck('id')
           );
       });
    }
}
