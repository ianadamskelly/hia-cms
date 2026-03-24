<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function show()
    {
        $events = Event::published()
            ->orderBy('start_at')
            ->get()
            ->map(fn ($event) => [
                'date' => $event->start_at->format('Y-m-d'),
                'title' => $event->title,
                'type' => $event->type,
                'category' => ucfirst($event->type),
            ]);

        return view('pages.calendar', compact('events'));
    }
}
