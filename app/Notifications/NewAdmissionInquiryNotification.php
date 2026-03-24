<?php

namespace App\Notifications;

use App\Models\AdmissionInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAdmissionInquiryNotification extends Notification
{
    use Queueable;

    public function __construct(
        public AdmissionInquiry $inquiry,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Admissions Inquiry')
            ->greeting('Hello,')
            ->line('A new admissions inquiry has been received.')
            ->line('Parent Name: '.$this->inquiry->parent_name)
            ->line('Student Name: '.($this->inquiry->student_name ?: 'N/A'))
            ->line('Email: '.($this->inquiry->email ?: 'N/A'))
            ->line('Phone: '.($this->inquiry->phone ?: 'N/A'))
            ->line('Programme Interest: '.($this->inquiry->programme_interest ?: 'N/A'))
            ->line('Campus Interest: '.($this->inquiry->campus_interest ?: 'N/A'))
            ->line('Message:')
            ->line($this->inquiry->message ?: 'No message provided.')
            ->action('View in Admin', url('/admin/admission-inquiries'))
            ->line('Please review and follow up as needed.');
    }
}
