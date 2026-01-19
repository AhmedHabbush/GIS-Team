<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['role', 'pages'])
            ->where('is_approved', true)
            ->latest()
            ->paginate(15);

        $pages = Page::where('is_active', true)->latest()->get();

        return view('admin.users.index', compact('users', 'pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $pages = Page::where('is_active', true)->latest()->get();

        return view('admin.users.create', compact('roles', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'phone' => ['nullable', 'string', 'max:20'],
                'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'password' => ['required', Password::min(8)],
                'role_id' => ['required', 'exists:roles,id'],
                'pages' => ['nullable', 'array'],
                'pages.*' => ['exists:pages,id'],
            ],
            [
                'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل',
                'email.email' => 'صيغة البريد الإلكتروني غير صحيحة',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
                'role_id.required' => 'يجب اختيار صلاحية للمستخدم',
                'profile_image.image' => 'يجب أن يكون الملف صورة',
                'profile_image.max' => 'حجم الصورة يجب أن لا يتجاوز 2MB',
            ]
        );

        $validated['password'] = Hash::make($validated['password']);

        // رفع الصورة الشخصية
        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'profile_image' => $validated['profile_image'] ?? null,
            'password' => $validated['password'],
            'role_id' => $validated['role_id'],
            'is_approved' => true,
        ]);

        if (!empty($validated['pages'])) {
            $user->pages()->sync($validated['pages']);
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'تم إضافة المستخدم بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $pages = Page::latest()->get();
        $userPages = $user->pages->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'pages', 'userPages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'password' => ['nullable', Password::min(8)],
            'pages' => ['nullable', 'array'],
            'pages.*' => ['exists:pages,id'],
        ];

        if (auth()->id() !== $user->id) {
            $rules['role_id'] = ['required', 'exists:roles,id'];
        }

        $validated = $request->validate($rules);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ];

        // رفع الصورة الجديدة
        if ($request->hasFile('profile_image')) {
            // حذف الصورة القديمة
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        }

        if (auth()->id() !== $user->id && isset($validated['role_id'])) {
            $data['role_id'] = $validated['role_id'];
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if (isset($validated['pages'])) {
            $user->pages()->sync($validated['pages']);
        } else {
            $user->pages()->detach();
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'تم تحديث المستخدم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'لا يمكنك حذف حسابك الخاص');
        }

        // حذف الصورة الشخصية
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->pages()->detach();
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'تم حذف المستخدم بنجاح');
    }

    public function pending()
    {
        $users = User::where('is_approved', false)->latest()->paginate(15);
        return view('admin.users.pending', compact('users'));
    }

    /**
     * Approve a pending user and update their role
     */
    public function approve(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        $user->update([
            'role_id' => $validated['role_id'],
            'is_approved' => true,
        ]);

        return redirect()
            ->route('admin.users.pending')
            ->with('success', 'تمت الموافقة على المستخدم بنجاح');
    }

    /**
     * عرض صفحة الاستيراد
     */
    public function importForm()
    {
        return view('admin.users.import');
    }

    /**
     * معاينة البيانات المستوردة
     */
    public function importPreview(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:2048'],
        ]);

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        if ($extension === 'csv') {
            $users = $this->parseCsv($file);
        } else {
            $users = $this->parseExcel($file);
        }

        if (empty($users)) {
            return back()->withErrors(['file' => 'الملف فارغ أو لا يحتوي على بيانات صحيحة']);
        }

        $validatedUsers = [];
        $roles = Role::pluck('id', 'key')->toArray();

        foreach ($users as $index => $user) {
            $errors = [];
            $warnings = [];

            if (empty($user['name'])) {
                $errors[] = 'الاسم مطلوب';
            }

            if (empty($user['email'])) {
                $errors[] = 'البريد الإلكتروني مطلوب';
            } elseif (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'صيغة البريد الإلكتروني غير صحيحة';
            } elseif (User::where('email', $user['email'])->exists()) {
                $errors[] = 'البريد الإلكتروني مستخدم بالفعل';
            }

            // التحقق من رقم الجوال
            if (!empty($user['phone']) && !preg_match('/^[0-9+\-\s()]+$/', $user['phone'])) {
                $warnings[] = 'تنسيق رقم الجوال قد يكون غير صحيح';
            }

            $roleId = null;
            if (empty($user['role'])) {
                $warnings[] = 'لم يتم تحديد صلاحية، سيتم استخدام صلاحية "user" افتراضياً';
                $roleId = $roles['user'] ?? null;
            } else {
                $roleKey = strtolower(trim($user['role']));
                $roleId = $roles[$roleKey] ?? null;
                if (!$roleId) {
                    $errors[] = "الصلاحية '{$user['role']}' غير موجودة";
                }
            }

            $password = !empty($user['password']) ? $user['password'] : 'password123';
            if (strlen($password) < 8) {
                $warnings[] = 'كلمة المرور قصيرة جداً، سيتم استخدام "password123"';
                $password = 'password123';
            }

            $pageUrls = [];
            if (!empty($user['pages'])) {
                $pageUrls = array_filter(array_map('trim', explode('|', $user['pages'])));
            }

            $validatedUsers[] = [
                'row' => $index + 2,
                'name' => $user['name'] ?? '',
                'email' => $user['email'] ?? '',
                'phone' => $user['phone'] ?? '',
                'role_key' => $user['role'] ?? 'user',
                'role_id' => $roleId,
                'password' => $password,
                'page_urls' => $pageUrls,
                'errors' => $errors,
                'warnings' => $warnings,
                'status' => empty($errors) ? 'valid' : 'invalid',
            ];
        }

        $sessionKey = 'import_preview_' . Str::random(10);
        Session::put($sessionKey, ['users' => $validatedUsers]);

        return view('admin.users.import-preview', [
            'users' => $validatedUsers,
            'sessionKey' => $sessionKey,
        ]);
    }

    /**
     * حفظ المستخدمين المستوردين
     */
    public function importStore(Request $request)
    {
        $request->validate([
            'session_key' => ['required', 'string'],
        ]);

        $data = Session::get($request->session_key);

        if (!$data) {
            return redirect()->route('admin.users.import')
                ->withErrors(['error' => 'انتهت صلاحية البيانات. يرجى إعادة رفع الملف.']);
        }

        $validUsers = collect($data['users'])->where('status', 'valid');
        $successCount = 0;
        $createdPages = [];

        foreach ($validUsers as $userData) {
            try {
                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'phone' => $userData['phone'] ?? null,
                    'password' => Hash::make($userData['password']),
                    'role_id' => $userData['role_id'],
                    'is_approved' => true,
                ]);

                if (!empty($userData['page_urls'])) {
                    $pageIds = [];

                    foreach ($userData['page_urls'] as $url) {
                        $page = Page::where('iframe_url', $url)->first();

                        if (!$page) {
                            $title = $this->generatePageTitle($url);
                            $slug = Str::slug($title);

                            $originalSlug = $slug;
                            $counter = 1;
                            while (Page::where('slug', $slug)->exists()) {
                                $slug = $originalSlug . '-' . $counter;
                                $counter++;
                            }

                            $page = Page::create([
                                'title' => $title,
                                'slug' => $slug,
                                'iframe_url' => $url,
                                'is_active' => true,
                            ]);

                            $createdPages[] = $page->title;
                        }

                        $pageIds[] = $page->id;
                    }

                    $user->pages()->sync($pageIds);
                }

                $successCount++;
            } catch (\Exception $e) {
                \Log::error('Failed to import user: ' . $e->getMessage());
            }
        }

        Session::forget($request->session_key);

        $message = "تم استيراد {$successCount} مستخدم بنجاح";
        if (count($createdPages) > 0) {
            $message .= " وتم إنشاء " . count($createdPages) . " صفحة جديدة";
        }

        return redirect()->route('admin.users.index')
            ->with('success', $message);
    }

    private function generatePageTitle($url)
    {
        $parsed = parse_url($url);
        $host = $parsed['host'] ?? '';
        $host = preg_replace('/^www\./', '', $host);

        if (!empty($host)) {
            return ucfirst(str_replace(['.com', '.net', '.org', '.io'], '', $host));
        }

        return 'صفحة ' . substr(md5($url), 0, 8);
    }

    private function parseCsv($file)
    {
        $users = [];
        $handle = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($handle);

        if (!$header || count($header) < 2) {
            fclose($handle);
            return [];
        }

        $header = array_map('strtolower', array_map('trim', $header));

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) >= 2) {
                $userData = [];
                foreach ($header as $index => $column) {
                    $userData[$column] = isset($row[$index]) ? trim($row[$index]) : '';
                }
                $users[] = $userData;
            }
        }

        fclose($handle);
        return $users;
    }

    private function parseExcel($file)
    {
        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            if (count($rows) < 2) {
                return [];
            }

            $header = array_map('strtolower', array_map('trim', array_shift($rows)));

            $users = [];
            foreach ($rows as $row) {
                if (empty(array_filter($row))) {
                    continue;
                }

                $userData = [];
                foreach ($header as $index => $column) {
                    $userData[$column] = isset($row[$index]) ? trim($row[$index]) : '';
                }

                $users[] = $userData;
            }

            return $users;
        } catch (\Exception $e) {
            \Log::error('Excel parsing error: ' . $e->getMessage());
            return [];
        }
    }
}
