<?php

test('profile can not follow itself', function () {
   $profile = \App\Models\Profile::factory()->create();

    expect(fn() => \App\Models\Follow::createFollow($profile, $profile))
        ->toThrow(InvalidArgumentException::class);

    expect($profile->followings)->contains($profile)->toBeFalse();
});

test('profile can follow another profile', function () {
    $profile = \App\Models\Profile::factory()->create();
    $anotherProfile = \App\Models\Profile::factory()->create();

    $follow = App\Models\Follow::createFollow($profile, $anotherProfile);

    expect($profile->followings)->contains($anotherProfile)->toBeTrue();
    expect($anotherProfile->followers)->contains($profile)->toBeTrue();

    expect($follow->follower)->is($profile)->toBeTrue();
    expect($follow->followed)->is($anotherProfile)->toBeTrue();
});

test('profile can unfollow another profile', function () {

});
