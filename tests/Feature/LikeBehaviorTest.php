<?php

use App\Models\Like;
use App\Models\Post;
use App\Models\Profile;

test('profile can like post', function () {
    $profile = Profile::factory()->create();

    $post = Post::factory()->create();

    $like = Like::createLike($profile, $post);

    expect($like->profile)->is($profile)->toBeTrue()
        ->and($like->post)->is($post)->toBeTrue()
        ->and($post->likes)->count()->toBe(1)
        ->and($post->likes)->contains($like)->toBeTrue()
        ->and($profile->likes)->contains($like)->toBeTrue();
});

test('can no create duplicate like', function () {
    $profile = Profile::factory()->create();

    $post = Post::factory()->create();

    $like = Like::createLike($profile, $post);
    $like2 = Like::createLike($profile, $post);

    expect($like->id)->toBe($like2->id);
});

test('can remove a like', function () {
    $profile = Profile::factory()->create();

    $post = Post::factory()->create();

    $like = Like::createLike($profile, $post);

    $success = Like::removeLike($profile, $post);

    expect($post->likes)->toHaveCount(0)
        ->and($success)->toBe(1);
});
