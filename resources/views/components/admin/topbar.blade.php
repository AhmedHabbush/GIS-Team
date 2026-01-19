<header class="topbar">
    <style>
        :root {
            --topbar-height: 70px;
        }

        .topbar {
            direction: ltr !important;
            height: var(--topbar-height);
            background: var(--bg-white);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 90;
            gap: 16px;
        }

        /* ===== Title - وسط الصفحة ===== */
        .topbar-title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
            white-space: nowrap;
            letter-spacing: 0.5px;
            text-align: center;
        }

        /* ===== User Section - أقصى اليسار ===== */
        .topbar-user {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-avatar-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border);
            transition: border-color 0.2s;
        }

        .user-avatar-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--border);
            overflow: hidden;
        }

        .user-avatar-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-trigger-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 14px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid transparent;
            background: transparent;
        }

        .user-trigger-btn:hover {
            background: var(--bg-light);
            border-color: var(--border);
        }

        .user-trigger-btn:hover .user-avatar-img {
            border-color: var(--primary);
        }

        .user-info {
            text-align: right;
            min-width: 120px;
        }

        .topbar-user-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.3;
            letter-spacing: 0.5px;
        }

        .topbar-user-role {
            font-size: 12px;
            color: var(--text-secondary);
            line-height: 1.3;
        }

        .dropdown-arrow {
            width: 16px;
            height: 16px;
            color: var(--text-muted);
            transition: transform 0.2s;
        }

        .user-trigger-btn:hover .dropdown-arrow {
            color: var(--primary);
        }

        /* ===== Responsive ===== */
        @media (max-width: 1024px) {
            .topbar {
                padding: 0 16px 0 70px;
                justify-content: flex-end;
            }

            .topbar-title {
                position: static;
                transform: none;
                margin: 0 auto;
                font-size: 18px;
            }

            .user-info {
                display: none;
            }

            .user-trigger-btn {
                padding: 6px;
            }

            .dropdown-arrow {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .topbar {
                padding: 0 12px 0 60px;
            }

            .topbar-title {
                font-size: 16px;
            }

            .user-avatar-img,
            .user-avatar-placeholder {
                width: 36px;
                height: 36px;
            }
        }
    </style>

    <!-- المستخدم - على اليمين -->
    <x-dropdown align="left" width="48">
        <div class="topbar-user">
            <x-slot name="trigger">
                <button class="user-trigger-btn">
                    <!-- Avatar -->
                    @if(auth()->user()->profile_image)
                        <img
                            src="{{ auth()->user()->profile_image_url }}"
                            alt="{{ auth()->user()->name }}"
                            class="user-avatar-img"
                        >
                    @else
                        <div class="user-avatar-placeholder">
                            <img
                                src="{{ asset('images/default-avatar.png') }}"
                                alt="{{ auth()->user()->name }}"
                            >
                        </div>
                    @endif

                    <!-- Info - مخفي على الموبايل -->
                    <div class="user-info">
                        <div class="topbar-user-name">
                            {{ auth()->user()->name }}
                        </div>
                        <div class="topbar-user-role">
                            {{ auth()->user()->role->display_name ?? 'مستخدم' }}
                        </div>
                    </div>

                    <!-- Arrow Icon - مخفي على الموبايل -->
                    <svg class="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link
                    :href="auth()->user()->isRole('admin') ? route('admin.profile.edit') : route('profile.edit')">
                    <div style="display:flex;align-items:center;gap:10px">
                        <svg style="width:18px;height:18px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ __('الملف الشخصي') }}
                    </div>
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        <div style="display:flex;align-items:center;gap:10px;color:var(--danger)">
                            <svg style="width:18px;height:18px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            {{ __('تسجيل خروج') }}
                        </div>
                    </x-dropdown-link>
                </form>
            </x-slot>
        </div>
    </x-dropdown>

    <!-- العنوان - في الوسط -->
    <h1 class="topbar-title">GIS Team</h1>
</header>
