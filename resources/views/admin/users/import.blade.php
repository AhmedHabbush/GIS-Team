<x-layout>
    <x-slot:title>استيراد المستخدمين</x-slot:title>

    <div style="max-width: 900px;">
        <div style="margin-bottom: 24px;">
            <a href="{{ route('admin.users.index') }}"
               style="color: var(--primary); text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"/>
                </svg>
                العودة إلى القائمة
            </a>
        </div>

        {{-- تعليمات الاستخدام --}}
        <x-card style="margin-bottom: 24px; background: #f0f9ff; border: 1px solid #7dd3fc;">
            <div style="display: flex; gap: 12px;">
                <div style="font-size: 24px;">💡</div>
                <div style="flex: 1;">
                    <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">
                        تعليمات تنسيق الملف
                    </h3>
                    <ul style="font-size: 14px; line-height: 1.8; color: #334155; margin: 0; padding-right: 20px;">
                        <li>الملف يجب أن يحتوي على الأعمدة التالية: <strong>Name, Email, Role, Password, Pages</strong></li>
                        <li>الصف الأول يجب أن يحتوي على عناوين الأعمدة بالضبط</li>
                        <li><strong>Name</strong>: اسم المستخدم (مطلوب)</li>
                        <li><strong>Email</strong>: البريد الإلكتروني (مطلوب وفريد)</li>
                        <li><strong>Role</strong>: الصلاحية (admin أو user) - اختياري، الافتراضي: user</li>
                        <li><strong>Password</strong>: كلمة المرور (اختياري، الافتراضي: password123)</li>
                        <li><strong>Pages</strong>: روابط الصفحات مفصولة بـ <code>|</code> (اختياري)</li>
                        <li>مثال للصفحات: <code>https://example.com/page1 | https://example.com/page2</code></li>
                        <li>صيغ الملفات المدعومة: Excel (.xlsx, .xls) أو CSV</li>
                        <li>الحد الأقصى لحجم الملف: 2 ميجابايت</li>
                    </ul>

                    <div style="margin-top: 16px; padding: 12px; background: #fef3c7; border-radius: 8px; border: 1px solid #fbbf24;">
                        <strong style="color: #92400e;">📝 مثال على صف في الملف:</strong>
                        <div style="margin-top: 6px; font-family: monospace; font-size: 12px; color: #92400e;">
                            أحمد محمد | [email protected] | user | mypassword123 | https://app.example.com|https://dashboard.example.com
                        </div>
                    </div>

                    <a href="{{ asset('samples/users-template.xlsx') }}"
                       download
                       style="display: inline-flex; align-items: center; gap: 6px; margin-top: 12px; color: #0284c7; text-decoration: none; font-size: 14px; font-weight: 500;">
                        📥 تحميل ملف نموذجي
                    </a>
                </div>
            </div>
        </x-card>

        <x-card>
            <x-slot:header>
                <h2 style="font-size: 18px; font-weight: 600;">رفع ملف المستخدمين</h2>
            </x-slot:header>

            <form method="POST"
                  action="{{ route('admin.users.import.preview') }}"
                  enctype="multipart/form-data"
                  x-data="{ fileName: '' }">
                @csrf

                {{-- رفع الملف --}}
                <div style="margin-bottom: 24px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 500;">
                        اختر الملف
                    </label>

                    <div style="
                        border: 2px dashed var(--border);
                        border-radius: 12px;
                        padding: 32px;
                        text-align: center;
                        background: var(--bg-light);
                        cursor: pointer;
                        transition: all 0.2s;
                    "
                         onclick="document.getElementById('file-input').click()"
                         @dragover.prevent="$el.style.borderColor='var(--primary)'"
                         @dragleave.prevent="$el.style.borderColor='var(--border)'"
                         @drop.prevent="
                            $el.style.borderColor='var(--border)';
                            fileName = $event.dataTransfer.files[0]?.name || '';
                            document.getElementById('file-input').files = $event.dataTransfer.files;
                         ">

                        <svg style="width: 48px; height: 48px; margin: 0 auto 12px; color: var(--primary);"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>

                        <div style="font-size: 15px; font-weight: 500; margin-bottom: 4px;">
                            <span x-show="!fileName">اضغط أو اسحب الملف هنا</span>
                            <span x-show="fileName" x-text="fileName" style="color: var(--primary);"></span>
                        </div>

                        <div style="font-size: 13px; color: var(--text-secondary);">
                            Excel (.xlsx, .xls) أو CSV
                        </div>
                    </div>

                    <input type="file"
                           id="file-input"
                           name="file"
                           accept=".xlsx,.xls,.csv"
                           required
                           style="display: none;"
                           @change="fileName = $event.target.files[0]?.name || ''">

                    @error('file')
                    <span style="color: var(--danger); font-size: 13px; margin-top: 4px; display: block;">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                {{-- أزرار الإجراءات --}}
                <div style="display: flex; gap: 12px;">
                    <button type="submit"
                            style="padding: 12px 24px; background: var(--primary); color: white; border: none; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer;">
                        معاينة البيانات
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                       style="padding: 12px 24px; background: var(--secondary); color: white; border-radius: 6px; font-size: 14px; font-weight: 500; text-decoration: none; display: inline-block;">
                        إلغاء
                    </a>
                </div>
            </form>
        </x-card>
    </div>
</x-layout>
