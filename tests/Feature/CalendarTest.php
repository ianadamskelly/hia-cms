<?php

use App\Models\Event;
use Carbon\Carbon;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('calendar page renders with dynamic events', function () {
    $this->withoutExceptionHandling();
    $event = Event::create([
        'title' => 'Test Academic Event',
        'slug' => 'test-academic-event',
        'type' => 'academic',
        'start_at' => Carbon::now()->startOfMonth()->addDays(10)->format('Y-m-d H:i:s'),
        'is_published' => true,
    ]);

    $response = $this->get('/calendar');

    $response->assertStatus(200);
    $response->assertSee('HIA School Calendar');
    $response->assertSee('Test Academic Event');
});

test('calendar filters events by published status', function () {
    $publishedEvent = Event::create([
        'title' => 'Published Event',
        'slug' => 'published-event',
        'type' => 'holiday',
        'start_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'is_published' => true,
    ]);

    $draftEvent = Event::create([
        'title' => 'Draft Event',
        'slug' => 'draft-event',
        'type' => 'holiday',
        'start_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'is_published' => false,
    ]);

    $response = $this->get('/calendar');

    $response->assertSee('Published Event');
    $response->assertDontSee('Draft Event');
});
