<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PortalPageController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        return view('iframe.show', compact('page'));
    }

}
