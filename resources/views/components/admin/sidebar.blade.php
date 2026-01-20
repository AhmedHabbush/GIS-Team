@props(['active' => null])

<style>
    :root {
        --sidebar-width: 280px;
    }

    /* ===== Sidebar Base ===== */
    .sidebar {
        width: var(--sidebar-width);
        background: var(--bg-white);
        border-left: 1px solid var(--border);
        position: fixed;
        height: 100vh;
        overflow-y: auto;
        z-index: 100;
        right: 0;
        top: 0;
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    /* ===== Mobile ===== */
    @media (max-width: 1024px) {
        .sidebar {
            transform: translateX(100%);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar-toggle {
            display: block;
        }
    }

    /* ===== Desktop ===== */
    @media (min-width: 1025px) {
        .sidebar-toggle {
            display: none;
        }
    }

    /* ===== Overlay ===== */
    .sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(62, 47, 31, 0.5);
        z-index: 90;
        display: none;
    }

    .sidebar-overlay.show {
        display: block;
    }

    /* ===== Sidebar Header - متطابق مع Topbar ===== */
    .sidebar-header {
        height: var(--topbar-height);
        padding: 0 24px;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .sidebar-logo {
        width: 80px;
        height: auto;
        max-height: 50px;
        object-fit: contain;
    }

    /* ===== Navigation ===== */
    .sidebar-nav {
        flex: 1;
        overflow-y: auto;
        padding: 16px 0;
    }

    .sidebar-nav::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
        background: var(--border);
        border-radius: 3px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb:hover {
        background: var(--primary-light);
    }

    /* ===== Section Headers ===== */
    .sidebar-section-header {
        padding: 8px 24px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        color: var(--text-secondary);
        letter-spacing: 0.5px;
        margin-top: 16px;
    }
</style>

<button
    onclick="toggleSidebar()"
    class="sidebar-toggle"
    style="
        position: fixed;
        top: 20px;
        right: 16px;
        z-index: 110;
        background: var(--primary);
        color: #fff;
        padding: 10px 12px;
        border-radius: 8px;
        border: none;
        font-size: 18px;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(107, 86, 56, 0.3);
        transition: all 0.2s;
    "
    onmouseover="this.style.background='var(--primary-dark)'"
    onmouseout="this.style.background='var(--primary)'"
>
    ☰
</button>

@php
    $userPages = auth()->user()->pages;
@endphp

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        GIS Team
        {{--<img src="{{ asset('images/logo.png') }}" alt="Logo" class="sidebar-logo">--}}
    </div>

    <nav class="sidebar-nav">
        @if(auth()->user()->isRole('admin'))
            <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>
                لوحة التحكم
            </x-nav-link>

            <div class="sidebar-section-header">الإدارة</div>

            <x-nav-link
                href="{{ route('admin.users.index') }}"
                :active="request()->routeIs('admin.users.index') || request()->routeIs('admin.users.create') || request()->routeIs('admin.users.edit') || request()->routeIs('admin.users.show') || request()->routeIs('admin.users.permissions')">
                <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
                إدارة المستخدمين
            </x-nav-link>

            <x-nav-link href="{{ route('admin.users.pending') }}" :active="request()->routeIs('admin.users.pending')">
                <svg style="width: 18px; height: 18px;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v4a1 1 0 00.293.707l2 2a1 1 0 001.414-1.414L11 10.586V7z"/>
                </svg>
                <span style="display:flex;align-items:center;gap:8px;width:100%;">
                    بانتظار الموافقة
                    @php
                        $pendingCount = \App\Models\User::where('is_approved', false)->count();
                    @endphp
                    @if($pendingCount)
                        <span style="
                            background: var(--warning);
                            color: #fff;
                            font-size: 11px;
                            padding: 2px 8px;
                            border-radius: 999px;
                            font-weight: 700;
                            margin-right: auto;
                        ">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </span>
            </x-nav-link>

            <x-nav-link href="{{ route('admin.pages.index') }}" :active="request()->routeIs('admin.pages.*')">
                <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                </svg>
                إدارة الصفحات
            </x-nav-link>

            <x-nav-link href="{{ route('admin.documents.index') }}" :active="request()->routeIs('admin.documents.*')">
                <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                </svg>
                إدارة المستندات
            </x-nav-link>

            <x-nav-link href="{{ route('admin.roles.index') }}" :active="request()->routeIs('admin.roles.*')">
                <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"/>
                    <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                </svg>
                إدارة الصلاحيات
            </x-nav-link>

            <x-nav-link href="{{ route('iframe.show') }}">
                <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                </svg>
                لوحة الخرائط
            </x-nav-link>
        @else
            <x-nav-link href="{{ route('user.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>
                لوحة التحكم
            </x-nav-link>

            @can('viewAny', \App\Models\Document::class)
                <x-nav-link href="{{ route('documents.store') }}" :active="request()->routeIs('documents.*')">
                    <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                    </svg>
                    المستندات
                </x-nav-link>
            @endcan

            @if($userPages->count())
                <x-nav-link href="{{ route('iframe.show') }}">
                    <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                    </svg>
                    لوحة الخرائط
                </x-nav-link>
            @endif
        @endif
    </nav>
</aside>

<!-- Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }

    document.querySelectorAll('.sidebar a').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 1024) {
                toggleSidebar();
            }
        });
    });
</script>
