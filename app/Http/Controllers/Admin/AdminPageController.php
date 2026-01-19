<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::get();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'iframe_url' => ['required', 'url'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if (Page::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] .= '-' . time();
        }

        Page::create($validated);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'تم إضافة الصفحة بنجاح');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'iframe_url' => ['required', 'url'],
        ]);

        // تحديث slug إذا تغيّر العنوان
        $newSlug = Str::slug($validated['title']);
        if ($newSlug !== $page->slug) {
            if (Page::where('slug', $newSlug)->where('id', '!=', $page->id)->exists()) {
                $newSlug .= '-' . time();
            }
            $validated['slug'] = $newSlug;
        }

        $page->update($validated);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'تم تحديث الصفحة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->users()->detach();
        $page->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'تم حذف الصفحة بنجاح');
    }
}
