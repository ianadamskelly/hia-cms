<?php

namespace App\Http\Controllers;

use App\Models\Download;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::with('category')
            ->published()
            ->paginate(12);

        return view('downloads.index', compact('downloads'));
    }

    public function show(string $slug)
    {
        $download = Download::with('category')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('downloads.show', compact('download'));
    }
}
