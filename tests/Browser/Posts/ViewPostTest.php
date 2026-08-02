<?php

use function Pest\Laravel\actingAs;

it('view a single post', function () {
    $authProfile = \App\Models\Profile::factory()->create();

    $this->actingAs($authProfile->user);

    $post = \App\Models\Post::factory()->for($authProfile)->create();

    visit(route('posts.index'))
//        ->click('@visit-post')
        ->click($authProfile->display_name)
        ->assertSee($post->content)
    ->screenshot();
});
