<?php

use App\Models\Programme;
use App\Models\Post;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('homepage renders correctly with all sections', function () {
    // Seed some data
    Programme::factory()->count(4)->create(['is_published' => true, 'is_featured' => true]);
    Post::factory()->count(3)->create(['is_published' => true]);

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Innovative Learning');
    $response->assertSee('Authorized IB World School');
    $response->assertSee('Core Institutional Values');
    $response->assertSee('Dugsiga');
    $response->assertSee('Keep Updated with HIA');
});

test('hero image is referenced correctly', function () {
    $response = $this->get('/');
    $response->assertSee('images/hero_campus.png');
});
