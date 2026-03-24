<?php

use App\Models\Page;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('about us page renders with premium template', function () {
    Page::factory()->create([
        'title' => 'About Us',
        'slug' => 'about-us',
        'is_published' => true,
    ]);

    $response = $this->get('/about-us');

    $response->assertStatus(200);
    $response->assertSee('Innovative Learning');
    $response->assertSee('Mohammed Isabirye');
    $response->assertSee('Our Vision');
    $response->assertSee('Our Mission');
    $response->assertSee('principal.png');
});

test('regular page still renders with default template', function () {
    Page::factory()->create([
        'title' => 'Privacy Policy',
        'slug' => 'privacy-policy',
        'content' => 'Our privacy policy content.',
        'is_published' => true,
    ]);

    $response = $this->get('/privacy-policy');

    $response->assertStatus(200);
    $response->assertSee('Privacy Policy');
    $response->assertSee('Our privacy policy content.');
    $response->assertDontSee('Mohammed Isabirye');
});
