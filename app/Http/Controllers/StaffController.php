<?php

namespace App\Http\Controllers;

use App\Models\Staff;

class StaffController extends Controller
{
    public function index()
    {
        $staffMembers = Staff::published()->get();

        return view('staff.index', compact('staffMembers'));
    }

    public function show(string $slug)
    {
        $staffMember = Staff::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('staff.show', compact('staffMember'));
    }
}
