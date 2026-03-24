<?php

namespace App\Support;

use Illuminate\Notifications\Notifiable;

class AdminNotifiable
{
    use Notifiable;

    public function routeNotificationForMail(): string
    {
        return config('mail.admin_address', config('mail.from.address'));
    }

    public function getKey(): string
    {
        return 'admin';
    }
}
