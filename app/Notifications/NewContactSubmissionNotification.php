<?php

namespace App\Notifications;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactSubmissionNotification extends Notification
{
    use Queueable;

    public function __construct(
        public ContactSubmission $submission,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Contact Submission')
            ->greeting('Hello,')
            ->line('A new contact submission has been received.')
            ->line('Name: '.$this->submission->name)
            ->line('Email: '.($this->submission->email ?: 'N/A'))
            ->line('Phone: '.($this->submission->phone ?: 'N/A'))
            ->line('Subject: '.($this->submission->subject ?: 'N/A'))
            ->line('Message:')
            ->line($this->submission->message)
            ->action('View in Admin', url('/admin/contact-submissions'))
            ->line('Please review and follow up as needed.');
    }
}
