<?php

use App\Models\ContactSubmission;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewContactSubmissionNotification;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('contact page renders with premium design', function () {
    $response = $this->get('/contact');

    $response->assertStatus(200);
    $response->assertSee('Connect with HIA');
    $response->assertSee('info@hia.edu.so');
    $response->assertSee('Heliwaa District');
    $response->assertSee('Banadir District');
    $response->assertSee('Send us a Message');
});

test('contact form submission works correctly', function () {
    $this->withoutExceptionHandling();
    Notification::fake();

    $response = $this->post('/contact', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'phone' => '123456789',
        'subject' => 'General Inquiry',
        'message' => 'This is a test message.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('contact_submissions', [
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    Notification::assertSentTo(
        new \App\Support\AdminNotifiable,
        NewContactSubmissionNotification::class
    );
});
