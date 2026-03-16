<?php

use App\Models\User;

it('shows the dashboard button on welcome page linking to books for authenticated users', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/');

    $response->assertOk();
    $response->assertSee('>ダッシュボード</a>', false);
    $response->assertSee('href="'.route('books.index').'" class="landing-ghost-btn">ダッシュボード</a>', false);
    $response->assertDontSee('href="'.route('dashboard').'" class="landing-ghost-btn">ダッシュボード</a>', false);
});
