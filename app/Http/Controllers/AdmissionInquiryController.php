<?php

namespace App\Http\Controllers;

use App\Models\AdmissionInquiry;
use App\Models\Campus;
use App\Models\Programme;
use App\Notifications\NewAdmissionInquiryNotification;
use App\Support\AdminNotifiable;
use Illuminate\Http\Request;

class AdmissionInquiryController extends Controller
{
    public function show()
    {
        $programmes = Programme::published()->get();
        $campuses = Campus::published()->get();

        return view('forms.admissions', compact('programmes', 'campuses'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'parent_name' => ['required', 'string', 'max:255'],
            'student_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'programme_interest' => ['nullable', 'string', 'max:255'],
            'campus_interest' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
        ]);

        $inquiry = AdmissionInquiry::create($validated);

        (new AdminNotifiable)->notify(new NewAdmissionInquiryNotification($inquiry));

        return redirect()
            ->back()
            ->with('success', 'Your admissions inquiry has been submitted successfully.');
    }
}
