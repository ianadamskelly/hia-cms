<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Notifications\NewContactSubmissionNotification;
use App\Support\AdminNotifiable;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('forms.contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $submission = ContactSubmission::create($validated);

        (new AdminNotifiable)->notify(new NewContactSubmissionNotification($submission));

        return redirect()
            ->back()
            ->with('success', 'Your message has been submitted successfully.');
    }
}
