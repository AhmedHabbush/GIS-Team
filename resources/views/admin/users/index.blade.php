<x-layout>
    <style>
        /* Profile Image Styles */
        .profile-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e5e7eb;
        }

        .profile-avatar-fallback {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #e5e7eb;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .user-name {
            font-weight: 600;
            color: #111827;
        }

        .user-email {
            font-size: 13px;
            color: var(--text-secondary);
        }

        /* Phone styling */
        .phone-number {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #374151;
            font-size: 14px;
        }

        .phone-icon {
            color: #9E8365;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .header-actions {
                width: 100%;
                flex-direction: column;
            }

            table thead {
                display: none;
            }

            table tbody tr {
                display: block;
                border: 1px solid var(--border-color);
                border-radius: 12px;
                margin-bottom: 12px;
                padding: 16px;
                background: #fff;
            }

            table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 0;
                border: none;
                font-size: 14px;
            }

            table tbody td::before {
                content: attr(data-label);
                font-size: 12px;
                font-weight: 600;
                color: var(--text-secondary);
                margin-left: 12px;
            }

            .user-info {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
            }

            .actions {
                justify-content: flex-start !important;
                flex-wrap: wrap;
                width: 100%;
            }

            .profile-avatar,
            .profile-avatar-fallback {
                width: 56px;
                height: 56px;
                font-size: 20px;
            }
        }
    </style>

    <x-slot:title>إدارة المستخدمين</x-slot:title>

    <div class="page-header"
         style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; flex-wrap: wrap; gap: 16px;">
        <h2 style="font-size: 20px; font-weight: 600; color: #111827;">قائمة المستخدمين</h2>

        <div class="header-actions" style="display: flex; gap: 8px;">
            <x-button href="{{ route('admin.users.import') }}" type="secondary">
                <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"/>
                </svg>
                استيراد من ملف
            </x-button>

            <x-button href="{{ route('admin.users.create') }}" type="primary">
                <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                </svg>
                إضافة مستخدم جديد
            </x-button>
        </div>
    </div>
    {{-- Search & Filter --}}
    <div style="
    display:flex;
    gap:12px;
    flex-wrap:wrap;
    margin-bottom:20px;
">
        <input
            id="searchInput"
            type="text"
            placeholder="ابحث بالاسم أو رقم الجوال..."
            style="
            flex:1;
            min-width:220px;
            padding:10px 14px;
            border-radius:10px;
            border:1px solid #e5e7eb;
            font-size:14px;
        "
        >

        <select
            id="roleFilter"
            style="
            min-width:200px;
            padding:10px 14px;
            border-radius:10px;
            border:1px solid #e5e7eb;
            font-size:14px;
            background:#fff;
        "
        >
            <option value="">كل الصلاحيات</option>
            @foreach(\App\Models\Role::all() as $role)
                <option value="{{ strtolower($role->display_name) }}">
                    {{ $role->display_name }}
                </option>
            @endforeach
        </select>
    </div>

    <x-card>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: var(--bg-light);">
                <tr>
                <th style="padding: 12px 16px; text-align: right; font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                        #
                    </th>
                    <th style="padding: 12px 16px; text-align: right; font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                        المستخدم
                    </th>
                    <th style="padding: 12px 16px; text-align: right; font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                        رقم الجوال
                    </th>
                    <th style="padding: 12px 16px; text-align: right; font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                        الصلاحية
                    </th>
                    <th style="padding: 12px 16px; text-align: center; font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                        الإجراءات
                    </th>
                </tr>
                </thead>

                <tbody>
                @forelse ($users as $user)
                    <tr
                        class="user-row"
                        data-name="{{ strtolower($user->name) }}"
                        data-phone="{{ strtolower($user->phone ?? '') }}"
                        data-role="{{ strtolower($user->role->display_name ?? 'user') }}"
                        style="border-bottom: 1px solid var(--border-color); transition: background 0.2s;"
                        onmouseover="this.style.background='#f9fafb'"
                        onmouseout="this.style.background='transparent'"
                    >
                    <td style="padding: 14px 16px;" data-label="#">
                            {{ $loop->iteration }}
                        </td>

                        <td style="padding: 14px 16px;" data-label="المستخدم">
                            <div class="user-info">
                                @if($user->profile_image)
                                    <img src="{{ $user->profile_image_url }}"
                                         alt="{{ $user->name }}"
                                         class="profile-avatar"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                                @else
                                    <div class="profile-avatar-fallback">
                                        <img src="{{ asset('images/default-avatar.png') }}" alt="">
                                    </div>
                                @endif

                                <div class="user-details">
                                    <span class="user-name">{{ $user->name }}</span>
                                    <span class="user-email">{{ $user->email }}</span>
                                </div>
                            </div>
                        </td>

                        <td style="padding: 14px 16px;" data-label="رقم الجوال">
                            @if($user->phone)
                                <div class="phone-number">
                                    <svg class="phone-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                    <span dir="ltr">{{ $user->phone }}</span>
                                </div>
                            @else
                                <span style="color: var(--text-secondary); font-size: 13px;">غير متوفر</span>
                            @endif
                        </td>

                        <td style="padding: 14px 16px;" data-label="الدور">
                            <span style="
                                padding: 6px 12px;
                                border-radius: 999px;
                                font-size: 12px;
                                font-weight: 500;
                                background: #c8c1bc;
                                color: #6B5638FF;
                                display: inline-block;
                            ">
                                {{ $user->role->display_name ?? 'User' }}
                            </span>
                        </td>

                        <td style="padding: 14px 16px; text-align: center;" data-label="الإجراءات">
                            <div class="actions" style="display: flex; justify-content: center; gap: 8px; flex-wrap: wrap;" >
                                <x-button type="secondary"
                                          href="{{ route('admin.users.permissions.edit', $user) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                        <path d="M9 12l2 2 4-4"/>
                                    </svg>
                                </x-button>

                                <x-button href="{{ route('admin.users.edit', $user) }}" type="secondary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </x-button>

                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                      onsubmit="return confirm('هل أنت متأكد من حذف المستخدم؟')">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="danger">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </x-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 60px; text-align: center;">
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <div style="color: var(--text-secondary); font-size: 16px;">
                                    لا يوجد مستخدمون حالياً
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            @if($users->hasPages())
                <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </x-card>
    <script>
        const searchInput = document.getElementById('searchInput');
        const roleFilter  = document.getElementById('roleFilter');
        const rows        = document.querySelectorAll('.user-row');

        function filterUsers() {
            const searchValue = searchInput.value.toLowerCase().trim();
            const roleValue   = roleFilter.value;

            rows.forEach(row => {
                const name  = row.dataset.name;
                const phone = row.dataset.phone;
                const role  = row.dataset.role;

                const matchSearch =
                    name.includes(searchValue) ||
                    phone.includes(searchValue);

                const matchRole =
                    roleValue === '' || role === roleValue;

                row.style.display = (matchSearch && matchRole) ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterUsers);
        roleFilter.addEventListener('change', filterUsers);
    </script>
</x-layout>
