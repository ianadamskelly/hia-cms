<?php

namespace App\Http\Controllers;

use App\Models\Campus;

class CampusController extends Controller
{
    public function index()
    {
        $campuses = Campus::published()->get();

        return view('campuses.index', compact('campuses'));
    }

    public function show(string $slug)
    {
        $campus = Campus::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('campuses.show', compact('campus'));
    }
}
