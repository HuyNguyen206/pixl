<?php

use function Pest\Laravel\actingAs;

it('like a post', function () {
    $authProfile = \App\Models\Profile::factory()->create();

    $this->actingAs($authProfile->user);

    $post = \App\Models\Post::factory()->for($authProfile)->create();
    $post2 = \App\Models\Post::factory()->for($authProfile)->create();

    visit(route('posts.index'))
        ->click("@like-button-$post->id")
        ->assertSeeIn("@like-count-$post->id", 1)
        ->click("@like-button-$post2->id")
        ->assertSeeIn("@like-count-$post2->id", 1)
        ->screenshot();

    expect($post->likeProfiles->contains(auth()->user()->profile))->toBeTrue();
    expect($post2->likeProfiles->contains(auth()->user()->profile))->toBeTrue();
    expect($post->likeProfiles)->toHaveCount(1);
    expect($post2->likeProfiles)->toHaveCount(1);
});
