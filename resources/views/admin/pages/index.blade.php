<x-layout>
    <x-slot:title>إدارة الصفحات</x-slot:title>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2 style="font-size: 20px; font-weight: 600;">قائمة الصفحات</h2>
        <x-button href="{{ route('admin.pages.create') }}" type="primary">
            <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
            </svg>
            إضافة صفحة جديدة
        </x-button>
    </div>

    <x-card>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: var(--bg-light);">
                <tr>
                    <th style="padding: 12px 16px; text-align: right; font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">#</th>
                    <th style="padding: 12px 16px; text-align: right; font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">العنوان</th>
                    <th style="padding: 12px 16px; text-align: right; font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">الرابط</th>
                    <th style="padding: 12px 16px; text-align: right; font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-secondary);">الإجراءات</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pages as $page)
                    <tr style="border-top: 1px solid var(--border);">
                        <td style="padding: 16px; font-size: 14px;">{{ $loop->iteration }}</td>
                        <td style="padding: 16px; font-size: 14px; font-weight: 500;">{{ $page->title }}</td>
                        <td style="padding: 16px; font-size: 13px; color: var(--text-secondary);">
                            <a href="{{ $page->iframe_url }}" target="_blank" style="color: var(--primary); text-decoration: none;">
                                {{ Str::limit($page->iframe_url, 50) }}
                            </a>
                        </td>
                        <td style="padding: 16px;">
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('admin.pages.edit', $page) }}" style="padding: 6px 12px; background: var(--primary); color: white; border-radius: 4px; font-size: 13px; text-decoration: none;">
                                    تعديل
                                </a>
                                <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="padding: 6px 12px; background: var(--danger); color: white; border: none; border-radius: 4px; font-size: 13px; cursor: pointer;">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 32px; text-align: center; color: var(--text-secondary);">
                            لا توجد صفحات
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-layout>
