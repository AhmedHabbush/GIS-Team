<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with(['users:id,name,email,role_id'])
        ->withCount('users')
            ->get();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'display_name' => ['required', 'string', 'max:255'],
        ]);

        Role::create([
            'display_name' => $validated['display_name'],
            'key' => Str::slug($validated['display_name'], '_'),
        ]);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'تم إضافة الصلاحية بنجاح');
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
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'display_name' => ['required', 'string', 'max:255'],
        ]);

        $role->update($validated);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'تم تحديث الصلاحية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف الصلاحية لأنها مرتبطة بمستخدمين');
        } elseif ($role->key === 'admin') {
            return back()->with('error', 'لا يمكن حذف صلاحية المدير');
        }
        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'تم حذف الصلاحية بنجاح');
    }
}
