<?php

namespace App\Http\Controllers;

use App\Models\Programme;

class ProgrammeController extends Controller
{
    public function index()
    {
        $programmes = Programme::published()->get();

        return view('programmes.index', compact('programmes'));
    }

    public function show(string $slug)
    {
        $programme = Programme::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('programmes.show', compact('programme'));
    }
}
