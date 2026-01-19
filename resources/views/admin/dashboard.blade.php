<x-layout>
    <x-slot:title>لوحة التحكم</x-slot:title>

    <!-- مرحباً بالمستخدم -->
    <div
        style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; padding: 32px; border-radius: 12px; margin-bottom: 32px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
            <div>
                <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 8px;">
                    مرحباً، {{ auth()->user()->name }}! 👋
                </h1>
                <p style="font-size: 16px; opacity: 0.9;">
                    {{ now()->locale('ar')->isoFormat('dddd، D MMMM YYYY') }}
                </p>
            </div>
            <div style="display: flex; gap: 12px;">
                <a href="{{ route('admin.users.index') }}"
                   style="padding: 12px 24px; background: rgba(255,255,255,0.2); color: white; border: 2px solid white; border-radius: 8px; text-decoration: none; font-weight: 500; backdrop-filter: blur(10px);">
                    إدارة المستخدمين
                </a>
            </div>
        </div>
    </div>

    <!-- بطاقات الإحصائيات -->
    <div
        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px; margin-bottom: 32px;">
        <!-- إجمالي المستخدمين -->
        <div
            style="background: var(--bg-white); border: 1px solid var(--border); border-radius: 12px; padding: 24px; position: relative; overflow: hidden;">
            <div
                style="position: absolute; top: -10px; right: -10px; width: 80px; height: 80px; background: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(37, 99, 235, 0.05)); border-radius: 50%;"></div>
            <div style="position: relative;">
                <div
                    style="width: 52px; height: 52px; border-radius: 12px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: var(--primary); display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <svg style="width: 26px; height: 26px;" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                </div>
                <div
                    style="font-size: 13px; color: var(--text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                    إجمالي المستخدمين
                </div>
                <div
                    style="font-size: 36px; font-weight: 800; color: var(--text-primary);">{{ \App\Models\User::count() }}</div>
                <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--border);">
                    <a href="{{ route('admin.users.index') }}"
                       style="color: var(--primary); font-size: 14px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 6px;">
                        عرض الكل
                        <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- إجمالي الصفحات -->
        <div
            style="background: var(--bg-white); border: 1px solid var(--border); border-radius: 12px; padding: 24px; position: relative; overflow: hidden;">
            <div
                style="position: absolute; top: -10px; right: -10px; width: 80px; height: 80px; background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05)); border-radius: 50%;"></div>
            <div style="position: relative;">
                <div
                    style="width: 52px; height: 52px; border-radius: 12px; background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: var(--success); display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <svg style="width: 26px; height: 26px;" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                    </svg>
                </div>
                <div
                    style="font-size: 13px; color: var(--text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                    إجمالي الصفحات
                </div>
                <div
                    style="font-size: 36px; font-weight: 800; color: var(--text-primary);">{{ \App\Models\Page::count() }}</div>
                <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--border);">
                    <a href="{{ route('admin.pages.index') }}"
                       style="color: var(--success); font-size: 14px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 6px;">
                        عرض الكل
                        <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- إجمالي المستندات -->
        <div
            style="background: var(--bg-white); border: 1px solid var(--border); border-radius: 12px; padding: 24px; position: relative; overflow: hidden;">
            <div
                style="position: absolute; top: -10px; right: -10px; width: 80px; height: 80px; background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(245, 158, 11, 0.05)); border-radius: 50%;"></div>
            <div style="position: relative;">
                <div
                    style="width: 52px; height: 52px; border-radius: 12px; background: linear-gradient(135deg, #fef3c7, #fde68a); color: var(--warning); display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <svg style="width: 26px; height: 26px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                    </svg>
                </div>
                <div
                    style="font-size: 13px; color: var(--text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                    إجمالي المستندات
                </div>
                <div
                    style="font-size: 36px; font-weight: 800; color: var(--text-primary);">{{ \App\Models\Document::count() }}</div>
                <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--border);">
                    <a href="{{ route('admin.documents.index') }}"
                       style="color: var(--warning); font-size: 14px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 6px;">
                        عرض الكل
                        <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- إجمالي الصلاحيات -->
        <div
            style="background: var(--bg-white); border: 1px solid var(--border); border-radius: 12px; padding: 24px; position: relative; overflow: hidden;">
            <div
                style="position: absolute; top: -10px; right: -10px; width: 80px; height: 80px; background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(99, 102, 241, 0.05)); border-radius: 50%;"></div>
            <div style="position: relative;">
                <div
                    style="width: 52px; height: 52px; border-radius: 12px; background: linear-gradient(135deg, #e0e7ff, #c7d2fe); color: #6366f1; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <svg style="width: 26px; height: 26px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"/>
                        <path
                            d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                    </svg>
                </div>
                <div
                    style="font-size: 13px; color: var(--text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                    إجمالي الصلاحيات
                </div>
                <div
                    style="font-size: 36px; font-weight: 800; color: var(--text-primary);">{{ \App\Models\Role::count() }}</div>
                <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--border);">
                    <a href="{{ route('admin.roles.index') }}"
                       style="color: #6366f1; font-size: 14px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 6px;">
                        عرض الكل
                        <svg style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px;">
        <!-- آخر المستخدمين المضافين -->
        <x-card>
            <x-slot:header>
                <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                    <h2 style="font-size: 18px; font-weight: 600; display: flex; align-items: center; gap: 10px;">
                        <svg style="width: 20px; height: 20px; color: var(--primary);" fill="currentColor"
                             viewBox="0 0 20 20">
                            <path
                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        آخر المستخدمين
                    </h2>
                    <a href="{{ route('admin.users.index') }}"
                       style="color: var(--primary); font-size: 13px; text-decoration: none; font-weight: 500;">عرض
                        الكل</a>
                </div>
            </x-slot:header>

            <div style="display: flex; flex-direction: column; gap: 12px;">
                @forelse(\App\Models\User::latest()->take(5)->get() as $user)
                    <div
                        style="display: flex; align-items: center; gap: 12px; padding: 12px; background: var(--bg-light); border-radius: 8px; transition: all 0.2s;"
                        onmouseover="this.style.background='#b3a99e'"
                        onmouseout="this.style.background='var(--bg-light)'">

                        <!-- User Avatar with Image or Fallback -->
                        <div style="width: 42px; height: 42px; border-radius: 50%; flex-shrink: 0; position: relative; overflow: hidden; border: 2px solid var(--border);">
                            @if($user->profile_image)
                                <!-- If user has profile image -->
                                <img
                                    src="{{ $user->profile_image_url }}"
                                    alt="{{ $user->name }}"
                                    style="width: 100%; height: 100%; object-fit: cover; display: block;"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >
                                <!-- Fallback for broken image -->
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; display: none; align-items: center; justify-content: center; font-weight: 600; font-size: 16px; position: absolute; top: 0; left: 0;">
                                    {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                                </div>
                            @else
                                <!-- If no profile image, show first letter -->
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 16px;">
                                    {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <!-- User Info -->
                        <div style="flex: 1; min-width: 0;">
                            <div
                                style="font-weight: 500; font-size: 14px; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $user->name }}
                            </div>
                            <div
                                style="font-size: 12px; color: var(--text-secondary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $user->email }}
                            </div>
                        </div>

                        <!-- Role Badge -->
                        <span
                            style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 500; background: #c8c1bc; color:#6B5638FF; white-space: nowrap;">
                    {{ $user->role->display_name ?? 'مستخدم' }}
                </span>
                    </div>
                @empty
                    <div style="text-align: center; padding: 32px; color: var(--text-secondary);">
                        لا يوجد مستخدمين
                    </div>
                @endforelse
            </div>
        </x-card>

        <!-- آخر المستندات المرفوعة -->
        <x-card>
            <x-slot:header>
                <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                    <h2 style="font-size: 18px; font-weight: 600; display: flex; align-items: center; gap: 10px;">
                        <svg style="width: 20px; height: 20px; color: var(--warning);" fill="currentColor"
                             viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                        </svg>
                        آخر المستندات
                    </h2>
                    <a href="{{ route('admin.documents.index') }}"
                       style="color: var(--warning); font-size: 13px; text-decoration: none; font-weight: 500;">عرض
                        الكل</a>
                </div>
            </x-slot:header>

            <div style="display: flex; flex-direction: column; gap: 12px;">
                @forelse(\App\Models\Document::with('files')->latest()->take(5)->get() as $document)
                    @php
                        $file = $document->main_file ?? $document->files->first();
                    @endphp

                    <div
                        style="
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px;
                background: var(--bg-light);
                border-radius: 8px;
                transition: all 0.2s;
            "
                        onmouseover="this.style.background='#fef3c7'"
                        onmouseout="this.style.background='var(--bg-light)'"
                    >
                        {{-- Icon --}}
                        <div
                            style="
                    width: 42px;
                    height: 42px;
                    border-radius: 8px;
                    background: linear-gradient(135deg, #fef3c7, #fde68a);
                    color: var(--warning);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-shrink: 0;
                "
                        >
                            <svg style="width: 22px; height: 22px;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                            </svg>
                        </div>

                        {{-- Info --}}
                        <div style="flex: 1; min-width: 0;">
                            <div
                                style="
                        font-weight: 500;
                        font-size: 14px;
                        color: var(--text-primary);
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    "
                            >
                                {{ $document->company }}
                            </div>

                            <div style="font-size: 12px; color: var(--text-secondary);">
                                @if($file)
                                    {{ number_format($file->file_size / 1024, 2) }} KB •
                                @endif
                                {{ $document->created_at->diffForHumans() }}
                            </div>
                        </div>

                        {{-- Action --}}
                        @if($file)
                            <a
                                href="{{ route('admin.document-files.download', $file) }}"
                                style="
                        padding: 6px 12px;
                        background: var(--warning);
                        color: white;
                        border-radius: 6px;
                        font-size: 12px;
                        text-decoration: none;
                        font-weight: 500;
                        white-space: nowrap;
                    "
                            >
                                تحميل
                            </a>
                        @endif
                    </div>
                @empty
                    <div style="text-align: center; padding: 32px; color: var(--text-secondary);">
                        لا يوجد مستندات
                    </div>
                @endforelse
            </div>

        </x-card>
    </div>

    @push('scripts')
        <script>
            console.log('Dashboard loaded successfully');
        </script>
    @endpush
</x-layout>
