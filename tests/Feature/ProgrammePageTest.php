<?php

use App\Models\Programme;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('programmes index page renders with premium design', function () {
    Programme::create([
        'name' => 'Elite Primary',
        'slug' => 'elite-primary',
        'age_range' => '5-11 Years',
        'is_published' => true,
    ]);

    $response = $this->get('/programmes');

    $response->assertStatus(200);
    $response->assertSee('Academic');
    $response->assertSee('Programmes');
    $response->assertSee('Elite Primary');
    $response->assertSee('5-11 Years');
});

test('programme detail page renders with immersive layout', function () {
    $programme = Programme::create([
        'name' => 'Secondary Excellence',
        'slug' => 'secondary-excellence',
        'description' => '<p>Deep secondary education content.</p>',
        'age_range' => '11-18 Years',
        'is_published' => true,
    ]);

    $response = $this->get("/programmes/{$programme->slug}");

    $response->assertStatus(200);
    $response->assertSee('Secondary Excellence');
    $response->assertSee('Deep secondary education content');
    $response->assertSee('Key Information'); // Sidebar header
});
