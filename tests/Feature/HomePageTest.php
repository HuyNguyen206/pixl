<?php

use App\Models\User;

use function Pest\Laravel\get;

it('renders the home page for guests', function () {
    get('/')
        ->assertOk()
        // The app resolves pages from resources/js/Pages, not Inertia's default lowercase path.
        ->assertInertia(fn ($page) => $page->component('Home', false));
});

it('redirects authenticated users away from the home page', function () {
    $this->actingAs(User::factory()->create());

    get('/')->assertRedirect();
});

it('logs in through the dev login link', function () {
    User::factory()->create();

    get(route('dev.login'))->assertRedirect(route('posts.index'));
});

it('sends the logout link back to the home page', function () {
    $this->actingAs(User::factory()->create());

    get('/dev/logout')->assertRedirect(route('login'));
});
