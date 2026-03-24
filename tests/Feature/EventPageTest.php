<?php

use App\Models\Event;
use Carbon\Carbon;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('events index page renders with premium design', function () {
    Event::factory()->create([
        'title' => 'Big School Event',
        'is_published' => true,
        'start_at' => Carbon::now()->addDays(5),
    ]);

    $response = $this->get('/events');

    $response->assertStatus(200);
    $response->assertSee('School Events');
    $response->assertSee('Big School Event');
    $response->assertSee('HIA Events Background'); // Hero alt text
});

test('event detail page renders with immersive layout', function () {
    $event = Event::factory()->create([
        'title' => 'Detailed Event Title',
        'is_published' => true,
        'description' => '<p>Special event description content.</p>',
        'location' => 'Main Auditorium',
    ]);

    $response = $this->get("/events/{$event->slug}");

    $response->assertStatus(200);
    $response->assertSee('Detailed Event Title');
    $response->assertSee('Special event description content');
    $response->assertSee('Main Auditorium');
    $response->assertSee('Event Schedule'); // Sidebar header
});
