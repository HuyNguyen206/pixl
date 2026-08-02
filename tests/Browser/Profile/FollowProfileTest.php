<?php

test('auth user follow another user', function () {
    $authProfile = \App\Models\Profile::factory()->create();

    $this->actingAs($authProfile->user);

    $followedProfile = \App\Models\Profile::factory()->create();

    visit(route('profiles.show', $followedProfile))
        ->click('@follow-button')
        ->assertSee('Unfollow')
        ->assertSee("You follow {$followedProfile->handle} successfully.")
        ->screenshot();

    expect($authProfile->followings->contains($followedProfile))->toBeTrue();
});
