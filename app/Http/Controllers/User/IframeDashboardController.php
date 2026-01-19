<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IframeDashboardController extends Controller
{
    public function show(Request $request)
    {
        $pages = $request->user()
            ->pages()
            ->where('pages.is_active', true)
            ->get([
                'pages.id',
                'pages.title',
                'pages.iframe_url',
            ]);


        return view('iframe.dashboard', [
            'pages' => $pages,
        ]);
    }
}
