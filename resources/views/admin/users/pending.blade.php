<x-layout>
    <x-slot:title>المستخدمون بانتظار الموافقة</x-slot:title>

    <style>
        .pending-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 20px;
        }

        .pending-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .06);
            transition: all .3s ease;
            position: relative;
        }

        .pending-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, .1);
            transform: translateY(-2px);
        }

        .pending-card.approved {
            opacity: 0;
            transform: scale(.95);
            pointer-events: none;
        }

        .user-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e5e7eb;
        }

        .user-avatar-placeholder {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #6B5D4F;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 24px;
            border: 3px solid #e5e7eb;
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background: #f9fafb;
            border-radius: 8px;
            font-size: 14px;
        }

        .info-icon {
            width: 20px;
            height: 20px;
            color: #6b7280;
        }

        .role-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            cursor: pointer;
            transition: all .2s;
        }

        .role-select:focus {
            outline: none;
            border-color:var(--primary);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .approve-btn {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            background: var(--primary);
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .approve-btn:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: var(--primary);
        }

        .approve-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, .3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        @media (max-width: 768px) {
            .pending-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div style="margin-bottom:24px">
        <h2 style="font-size:24px;font-weight:700;color:#6B5D4F;margin-bottom:8px">
            ⏳ مستخدمون بانتظار الموافقة
        </h2>
        <p style="color:#6b7280;font-size:14px">
            راجع وافق على طلبات التسجيل الجديدة
        </p>
    </div>

    @if($users->isEmpty())
        <div style="background:white;border-radius:16px;padding:48px;text-align:center;border:1px solid #e5e7eb">
            <div style="font-size:64px;margin-bottom:16px">🎉</div>
            <p style="font-size:18px;font-weight:600;color:#6B5D4F;margin-bottom:8px">
                لا يوجد مستخدمون بانتظار الموافقة
            </p>
            <p style="color:#6b7280;font-size:14px">
                جميع الطلبات تمت معالجتها
            </p>
        </div>
    @else
        <div class="pending-grid">
            @foreach($users as $user)
                <div class="pending-card" id="user-card-{{ $user->id }}">
                    <!-- رأس البطاقة -->
                    <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid #f3f4f6">
                        @if($user->profile_image)
                            <img src="{{ $user->profile_image_url }}" alt="{{ $user->name }}" class="user-avatar">
                        @else
                            <div class="user-avatar-placeholder">
                                {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                            </div>
                        @endif

                        <div style="flex:1">
                            <h3 style="font-weight:700;font-size:16px;color:#111827;margin-bottom:4px">
                                {{ $user->name }}
                            </h3>
                            <span class="badge badge-pending">قيد المراجعة</span>
                        </div>
                    </div>

                    <!-- معلومات المستخدم -->
                    <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:20px">
                        <!-- البريد الإلكتروني -->
                        <div class="info-row">
                            <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                            <span style="color:#374151">{{ $user->email }}</span>
                        </div>

                        <!-- رقم الجوال -->
                        @if($user->phone)
                            <div class="info-row">
                                <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span style="color:#374151">{{ $user->phone }}</span>
                            </div>
                        @endif

                        <!-- تاريخ التسجيل -->
                        <div class="info-row">
                            <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span style="color:#6b7280">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- اختيار الصلاحية -->
                    <form method="POST" action="{{ route('admin.users.approve', $user) }}" id="form-{{ $user->id }}">
                        @csrf
                        @method('PATCH')

                        <div style="margin-bottom:16px">
                            <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:8px">
                                الصلاحية
                            </label>
                            <select name="role_id" class="role-select" required>
                                <option value="">اختر الصلاحية</option>
                                @foreach(\App\Models\Role::all() as $role)
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->display_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button
                            type="submit"
                            class="approve-btn"
                            onclick="handleApprove(event, {{ $user->id }})"
                        >
                            <svg style="width:20px;height:20px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>الموافقة على المستخدم</span>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        @if($users->hasPages())
            <div style="margin-top:32px">
                {{ $users->links() }}
            </div>
        @endif
    @endif

    <script>
        function handleApprove(event, userId) {
            event.preventDefault();
            const form = document.getElementById('form-' + userId);
            const button = form.querySelector('.approve-btn');
            const roleSelect = form.querySelector('.role-select');

            if (!roleSelect.value) {
                alert('الرجاء اختيار الصلاحية أولاً');
                return;
            }

            button.disabled = true;
            button.innerHTML = '<div class="spinner"></div><span>جارٍ الموافقة...</span>';

            form.submit();
        }
    </script>
</x-layout>
