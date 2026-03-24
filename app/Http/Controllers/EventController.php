<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::published()
            ->upcoming()
            ->paginate(9);

        return view('events.index', compact('events'));
    }

    public function show(string $slug)
    {
        $event = Event::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('events.show', compact('event'));
    }
}
