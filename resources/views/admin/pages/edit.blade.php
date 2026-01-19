<x-layout>
    <x-slot:title>تعديل الصفحة</x-slot:title>

    <div style="max-width: 800px;">
        <div style="margin-bottom: 24px;">
            <a href="{{ route('admin.pages.index') }}" style="color: var(--primary); text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"/>
                </svg>
                العودة إلى القائمة
            </a>
        </div>

        <x-card>
            <x-slot:header>
                <h2 style="font-size: 18px; font-weight: 600;">تعديل معلومات الصفحة</h2>
            </x-slot:header>

            <form method="POST" action="{{ route('admin.pages.update', $page) }}">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 500;">عنوان الصفحة</label>
                    <input type="text" name="title" value="{{ old('title', $page->title) }}" required
                           style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                    @error('title')
                    <span style="color: var(--danger); font-size: 13px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 500;">
                        رابط الصفحة (URL)
                    </label>
                    <input type="url" name="iframe_url"
                           value="{{ old('iframe_url', $page->iframe_url) }}" required
                           style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                    @error('iframe_url')
                    <span style="color: var(--danger); font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>


                <div style="display: flex; gap: 12px; margin-top: 24px;">
                    <button type="submit" style="padding: 10px 24px; background: var(--success); color: white; border: none; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer;">
                        حفظ التغييرات
                    </button>
                    <a href="{{ route('admin.pages.index') }}" style="padding: 10px 24px; background: var(--secondary); color: white; border-radius: 6px; font-size: 14px; font-weight: 500; text-decoration: none; display: inline-block;">
                        إلغاء
                    </a>
                </div>
            </form>
        </x-card>
    </div>
</x-layout>
