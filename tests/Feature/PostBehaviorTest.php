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

test('can replied a post', function () {
    $orignial = \App\Models\Post::factory()->create(['parent_id' => null, 'repost_of_id' => null]);

    $replier = \App\Models\Profile::factory()->create();

    $reply = \App\Models\Post::replyToPost($orignial, $replier, 'Hello world!');

    expect($reply->parentPost)->is($orignial)->toBeTrue()
        ->and($orignial->replies)->count()->toBe(1)
        ->and($orignial->replies)->contains($reply);

});

test('can have many replies a post', function () {
    $orignial = \App\Models\Post::factory()->create(['parent_id' => null, 'repost_of_id' => null]);

    $replies = \App\Models\Post::factory(4)->replyToParent($orignial)->create(
        ['repost_of_id' => null]
    );
    expect($orignial->replies)->count()->toBe(4)
         ->and($orignial->replies->pluck('id')->toArray())
         ->toEqual($replies->pluck('id')->toArray())
    ->and($replies->first()->parentPost)->is($orignial)->toBeTrue();

});

test('create plain repost', function () {
    $orignial = \App\Models\Post::factory()->create(['parent_id' => null, 'repost_of_id' => null]);

    $replier = \App\Models\Profile::factory()->create();

    $repost = \App\Models\Post::repostOfPost($orignial, $replier);

    expect($repost->parentRepost)->is($orignial)->toBeTrue()
        ->and($orignial->reposts)->count()->toBe(1)
        ->and($repost->content)->toBeNull()
        ->and($orignial->reposts)->contains($repost);

});


test('can have many plain repost', function () {
    $orignial = \App\Models\Post::factory()
        ->create(['parent_id' => null, 'repost_of_id' => null]);

    $reposts = \App\Models\Post::factory(2)->repostOf($orignial)->create();

    expect($orignial->reposts)->count()->toBe(2)
        ->and($orignial->reposts)->contains($reposts->first())
        ->and($reposts->first()->parentRepost->id)->toBe($orignial->id);

});

test('create quote repost', function () {
    $orignial = \App\Models\Post::factory()->create();

    $replier = \App\Models\Profile::factory()->create();

    $repost = \App\Models\Post::repostOfPost($orignial, $replier, $message = 'QUOTE CONTENT');

    expect($repost->parentRepost)->is($orignial)->toBeTrue()
        ->and($orignial->reposts)->count()->toBe(1)
        ->and($orignial->reposts)->contains($repost)
        ->and($repost->content)->toBe($message);

});

test('prevent duplicate reposts', function () {
    $orignial = \App\Models\Post::factory()->create();

    $replier = \App\Models\Profile::factory()->create();

    $repost = \App\Models\Post::repostOfPost($orignial, $replier, $message = 'QUOTE CONTENT');
    $repost2 = \App\Models\Post::repostOfPost($orignial, $replier, $message = 'QUOTE CONTENT');

    $repost3 = \App\Models\Post::repostOfPost($orignial, \App\Models\Profile::factory()->create(), $message = 'QUOTE CONTENT');

    expect($repost->id)->toBe($repost2->id);

    assertCount(1, $orignial->reposts()->where('profile_id', $replier->id)->get());
});

test('remove a repost', function () {
    $orignial = \App\Models\Post::factory()->create();

   $profile = \App\Models\Post::factory()->repostOf($orignial)->create()->profile;

  $success = \App\Models\Post::removeRepostOfPost($orignial, $profile);

    expect($orignial->reposts)->toHaveCount(0)
    ->and($success);

});


