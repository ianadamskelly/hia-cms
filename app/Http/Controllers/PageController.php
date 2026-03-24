<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        if (view()->exists("pages.{$slug}")) {
            return view("pages.{$slug}", compact('page'));
        }

        return view('pages.show', compact('page'));
    }
}
