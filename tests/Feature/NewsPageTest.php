<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('news index page renders with premium design', function () {
    Post::factory()->create([
        'title' => 'Important School Update',
        'is_published' => true,
        'published_at' => now(),
    ]);

    $response = $this->get('/news');

    $response->assertStatus(200);
    $response->assertSee('School');
    $response->assertSee('News');
    $response->assertSee('Important School Update');
    $response->assertSee('Featured Story');
});

test('news detail page renders with immersive layout', function () {
    $post = Post::factory()->create([
        'author_id' => User::factory(),
        'title' => 'Refined Article Title',
        'is_published' => true,
        'content' => '<p>High quality news content.</p>',
        'published_at' => now(),
    ]);

    $response = $this->get("/news/{$post->slug}");

    $response->assertStatus(200);
    $response->assertSee('Refined Article Title');
    $response->assertSee('High quality news content');
    $response->assertSee('Authored By');
});
