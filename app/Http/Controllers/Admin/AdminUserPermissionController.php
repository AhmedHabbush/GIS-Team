<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserPermissionController extends Controller
{
    public function edit(User $user)
    {
        $permissions = Permission::all();

        return view('admin.users.permissions', compact('user', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'permissions' => ['array'],
        ]);

        $user->permissions()->sync($request->permissions ?? []);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'تم تحديث الصلاحيات بنجاح');
    }
}
