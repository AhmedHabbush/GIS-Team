<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class IframeController extends Controller
{
    /**
     *
     *
     * @param Request $request
     * @return View
     */
    public function show(Request $request)
    {
        $user = $request->user();

        $pages = $user->isRole('admin')
            ? Page::where('is_active', true)->get()
            : $user->pages()->where('is_active', true)->get();

        abort_if($pages->isEmpty(), 403);

        return view('iframe.dashboard', compact('pages'));
    }
}
