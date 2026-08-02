<?php

use function Pest\Laravel\actingAs;

test('auth user can view their timeline', function () {
    $authProfile = \App\Models\Profile::factory()->create();

    $this->actingAs($authProfile->user);

    $followedProfile = \App\Models\Profile::factory()->create();

    $authProfile->follow($followedProfile);

    \App\Models\Post::factory(3)->create([
        'profile_id' => $followedProfile->id
    ]);

    \App\Models\Post::factory()->for($authProfile)->create();

    expect($authProfile->followings->contains($followedProfile))->toBeTrue();

    visit(route('posts.index'))
//        ->assertSee('Home');
        ->assertCount('@post-feed-item', 4)
        ->screenshot();
});
