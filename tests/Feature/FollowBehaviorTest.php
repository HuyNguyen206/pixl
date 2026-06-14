<?php

use App\Models\Follow;
use App\Models\Profile;

test('profile can not follow itself', function () {
    $profile = Profile::factory()->create();

    expect(fn () => Follow::createFollow($profile, $profile))
        ->toThrow(InvalidArgumentException::class);

    expect($profile->followings)->contains($profile)->toBeFalse();
});

test('profile can follow another profile', function () {
    $profile = Profile::factory()->create();
    $anotherProfile = Profile::factory()->create();

    $follow = Follow::createFollow($profile, $anotherProfile);

    expect($profile->followings)->contains($anotherProfile)->toBeTrue();
    expect($anotherProfile->followers)->contains($profile)->toBeTrue();

    expect($follow->follower)->is($profile)->toBeTrue();
    expect($follow->followed)->is($anotherProfile)->toBeTrue();
});

test('profile can unfollow another profile', function () {
    $profile = Profile::factory()->create();
    $anotherProfile = Profile::factory()->create();

    $follow = Follow::createFollow($profile, $anotherProfile);

    Follow::unfollow($profile, $anotherProfile);

    expect($profile->followings)->contains($anotherProfile)->toBeFalse();
    expect($anotherProfile->followers)->contains($profile)->toBeFalse();
});
