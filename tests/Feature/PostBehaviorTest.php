<?php

use function PHPUnit\Framework\assertCount;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('allow a profile to publish a post', function () {
    \Pest\Laravel\withoutExceptionHandling();

    $user = \App\Models\User::factory()->create();
   $post = \App\Models\Post::publish($profile = \App\Models\Profile::factory()->create(), 'Hello world!');
    expect($post->exists)->toBeTrue()
    ->and($post->profile)->is($profile)->toBeTrue()
    ->and($post->content)->toBe('Hello world!')
    ->and($post->parent_id)->toBeNull()
    ->and($post->repost_of_id)->toBeNull();
});

test('user can create a post', function () {
    \Pest\Laravel\withoutExceptionHandling();

    \Pest\Laravel\actingAs($user = \App\Models\User::factory()->create());
    $profile = \App\Models\Profile::factory()->create(['user_id' => $user->id]);
    $response = $this->post(route('posts.store'), [
        'content' => 'Hello world!',
    ]);

    //    $response->assertStatus(200);
    $this->assertDatabaseHas('posts', [
            'content' => 'Hello world!',
            'profile_id' => $profile->id,
        ]
    );

    assertCount(1, $profile->posts);
});
