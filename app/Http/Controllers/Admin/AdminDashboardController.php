<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'users' => User::count(),
            'pages' => Page::count(),
            'documents' => Document::count(),
        ]);
    }
    public function show(Page $page)
    {
        // التحقق من أن المستخدم لديه صلاحية الوصول لهذه الصفحة
        if (!auth()->user()->pages->contains($page->id)) {
            abort(403, 'ليس لديك صلاحية الوصول لهذه الصفحة');
        }

        return view('admin.pages.show', compact('page'));
    }
}
