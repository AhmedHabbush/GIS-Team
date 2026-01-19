<x-layout>
    <x-slot:title>معاينة الاستيراد</x-slot:title>

    <div style="max-width: 1400px;">
        <div style="margin-bottom: 24px;">
            <a href="{{ route('admin.users.import') }}"
               style="color: var(--primary); text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"/>
                </svg>
                رفع ملف جديد
            </a>
        </div>

        {{-- ملخص الاستيراد --}}
        @php
            $validCount = collect($users)->where('status', 'valid')->count();
            $invalidCount = collect($users)->where('status', 'invalid')->count();
            $totalCount = count($users);
            $warningsCount = collect($users)->filter(fn($u) => !empty($u['warnings']))->count();
        @endphp

        <x-card style="margin-bottom: 24px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px;">
                <div style="text-align: center; padding: 16px;">
                    <div style="font-size: 32px; font-weight: 700; color: #0ea5e9;">
                        {{ $totalCount }}
                    </div>
                    <div style="font-size: 13px; color: var(--text-secondary); margin-top: 4px;">
                        إجمالي السجلات
                    </div>
                </div>

                <div style="text-align: center; padding: 16px;">
                    <div style="font-size: 32px; font-weight: 700; color: #10b981;">
                        {{ $validCount }}
                    </div>
                    <div style="font-size: 13px; color: var(--text-secondary); margin-top: 4px;">
                        سجلات صحيحة
                    </div>
                </div>

                <div style="text-align: center; padding: 16px;">
                    <div style="font-size: 32px; font-weight: 700; color: #ef4444;">
                        {{ $invalidCount }}
                    </div>
                    <div style="font-size: 13px; color: var(--text-secondary); margin-top: 4px;">
                        سجلات خاطئة
                    </div>
                </div>

                @if($warningsCount > 0)
                    <div style="text-align: center; padding: 16px;">
                        <div style="font-size: 32px; font-weight: 700; color: #f59e0b;">
                            {{ $warningsCount }}
                        </div>
                        <div style="font-size: 13px; color: var(--text-secondary); margin-top: 4px;">
                            تحذيرات
                        </div>
                    </div>
                @endif
            </div>
        </x-card>

        {{-- جدول المعاينة --}}
        <x-card>
            <x-slot:header>
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                    <h2 style="font-size: 18px; font-weight: 600;">معاينة البيانات</h2>

                    @if($validCount > 0)
                        <form method="POST" action="{{ route('admin.users.import.store') }}" style="display: inline;">
                            @csrf
                            <input type="hidden" name="session_key" value="{{ $sessionKey }}">
                            <button type="submit"
                                    onclick="return confirm('هل أنت متأكد من حفظ {{ $validCount }} مستخدم؟\n\nسيتم إنشاء الصفحات الجديدة تلقائياً.')"
                                    style="padding: 10px 20px; background: #10b981; color: white; border: none; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer;">
                                ✓ حفظ {{ $validCount }} مستخدم
                            </button>
                        </form>
                    @endif
                </div>
            </x-slot:header>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                    <thead style="background: var(--bg-light);">
                    <tr>
                        <th style="padding: 10px 12px; text-align: right; font-size: 11px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                            الصف
                        </th>
                        <th style="padding: 10px 12px; text-align: right; font-size: 11px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                            الحالة
                        </th>
                        <th style="padding: 10px 12px; text-align: right; font-size: 11px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                            الاسم
                        </th>
                        <th style="padding: 10px 12px; text-align: right; font-size: 11px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                            البريد
                        </th>
                        <th style="padding: 10px 12px; text-align: right; font-size: 11px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                            الصلاحية
                        </th>
                        <th style="padding: 10px 12px; text-align: right; font-size: 11px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                            كلمة المرور
                        </th>
                        <th style="padding: 10px 12px; text-align: right; font-size: 11px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                            الصفحات
                        </th>
                        <th style="padding: 10px 12px; text-align: right; font-size: 11px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">
                            ملاحظات
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr style="border-bottom: 1px solid var(--border); {{ $user['status'] === 'invalid' ? 'background: #fef2f2;' : '' }}">
                            <td style="padding: 12px; font-weight: 600; color: #64748b;">
                                #{{ $user['row'] }}
                            </td>

                            <td style="padding: 12px;">
                                @if($user['status'] === 'valid')
                                    <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 8px; border-radius: 999px; font-size: 11px; background: #d1fae5; color: #065f46; font-weight: 600;">
                                    ✓ صحيح
                                </span>
                                @else
                                    <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 8px; border-radius: 999px; font-size: 11px; background: #fee2e2; color: #991b1b; font-weight: 600;">
                                    ✕ خطأ
                                </span>
                                @endif
                            </td>

                            <td style="padding: 12px;">
                                {{ $user['name'] ?: '-' }}
                            </td>

                            <td style="padding: 12px;" dir="ltr" style="text-align: right;">
                            <span style="font-family: monospace; font-size: 12px;">
                                {{ $user['email'] ?: '-' }}
                            </span>
                            </td>

                            <td style="padding: 12px;">
                            <span style="padding: 3px 8px; border-radius: 6px; font-size: 11px; background: #e0e7ff; color: #4338ca; font-weight: 600;">
                                {{ $user['role_key'] }}
                            </span>
                            </td>

                            <td style="padding: 12px;">
                            <span style="font-family: monospace; font-size: 11px; color: #64748b;">
                                {{ Str::mask($user['password'], '*', 0) }}
                            </span>
                            </td>

                            <td style="padding: 12px;">
                                @if(!empty($user['page_urls']))
                                    <div style="display: flex; flex-direction: column; gap: 4px;">
                                        @foreach($user['page_urls'] as $url)
                                            <span style="font-size: 11px; color: #0284c7; font-family: monospace; background: #f0f9ff; padding: 2px 6px; border-radius: 4px;">
                                            {{ Str::limit($url, 40) }}
                                        </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span style="color: #94a3b8;">-</span>
                                @endif
                            </td>

                            <td style="padding: 12px;">
                                @if(!empty($user['errors']))
                                    <ul style="margin: 0; padding: 0; list-style: none; font-size: 12px; color: #dc2626;">
                                        @foreach($user['errors'] as $error)
                                            <li style="margin-bottom: 2px;">❌ {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if(!empty($user['warnings']))
                                    <ul style="margin: 0; padding: 0; list-style: none; font-size: 12px; color: #d97706;">
                                        @foreach($user['warnings'] as $warning)
                                            <li style="margin-bottom: 2px;">⚠️ {{ $warning }}</li>
                                        @endforeach
                                    </ul>
                                 @endif
                                    @if(empty($user['errors']) && empty($user['warnings']))
                                        <span style="color: #10b981; font-size: 18px;">✓</span>
                                    @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
</x-layout>
