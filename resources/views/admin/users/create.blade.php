<x-layout>
    <x-slot:title>إضافة مستخدم جديد</x-slot:title>

    <div style="max-width: 800px;">
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

        <x-card>
            <x-slot:header>
                <h2 style="font-size: 18px; font-weight: 600;">معلومات المستخدم</h2>
            </x-slot:header>

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 500;">الاسم
                        الثلاثي</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;"
                           placeholder="أدخل الاسم الثلاثي">
                    @error('name')
                    <span
                        style="color: var(--danger); font-size: 13px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 500;">البريد
                        الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;"
                           placeholder="example@domain.com">
                    @error('email')
                    <span
                        style="color: var(--danger); font-size: 13px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 500;">كلمة
                        المرور</label>
                    <input type="password" name="password" required
                           style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;"
                           placeholder="أدخل كلمة المرور">
                    @error('password')
                    <span
                        style="color: var(--danger); font-size: 13px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label
                        style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 500;">الصلاحية</label>
                    <select name="role_id" required
                            style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value=""> اختر الصلاحية</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->display_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                    <span
                        style="color: var(--danger); font-size: 13px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div
                    x-data="multiSelect({
                    options: @js($pages->map(fn($p) => ['id' => $p->id, 'label' => $p->title])),
                    selected: @js(old('pages', [])) })"
                    style="margin-bottom:24px; position:relative;">
                    <label style="display:block;margin-bottom:8px;font-size:14px;font-weight:500;">
                        الصفحات المتاحة
                    </label>

                    <!-- Trigger -->
                    <div
                        @click="open = !open"
                        style="min-height:48px; padding:8px 12px; border:1px solid var(--border);
                            border-radius:8px;
                            display:flex;
                            flex-wrap:wrap;
                            gap:6px;
                            align-items:center;
                            cursor:pointer;
                            background:#fff;
                            box-shadow:0 1px 2px rgba(0,0,0,.04);">
                        <!-- Tags -->
                        <template x-for="item in selectedItems" :key="item.id">
            <span
                style="
                    background:#e8f1fb;
                    color:#1f73b7;
                    padding:5px 10px;
                    border-radius:6px;
                    font-size:13px;
                    display:flex;
                    align-items:center;
                    gap:6px;
                "
                @click.stop>
                <span x-text="item.label"></span>
                <button
                    type="button"
                    @click="remove(item.id)"
                    style="background:none;border:none;color:#1f73b7;cursor:pointer;font-size:14px;"
                >
                    ✕
                </button>
            </span>
                        </template>

                        <!-- Placeholder -->
                        <span
                            x-show="selected.length === 0"
                            style="color:#9ca3af;font-size:13px;">
                            اختر الصفحات المسموحة
                        </span>

                        <!-- Arrow -->
                        <span style="margin-right:auto;color:#9ca3af;font-size:12px;">
                            ▼
                        </span>
                    </div>

                    <!-- Dropdown -->
                    <div
                        x-show="open"
                        x-transition
                        @click.outside="open = false"
                        style="
                            position:absolute;
                            width:100%;
                            background:white;
                            border:1px solid var(--border);
                            border-radius:8px;
                            margin-top:6px;
                            max-height:220px;
                            overflow-y:auto;
                            z-index:50;
                            box-shadow:0 10px 25px rgba(0,0,0,.08);
                        "
                    >
                        <template x-for="option in options" :key="option.id">
                            <div
                                @click="toggle(option.id)"
                                style="
                                    padding:10px 14px;
                                    cursor:pointer;
                                    font-size:14px;
                                    transition:background .15s;
                                "
                                :style="selected.includes(option.id)
                                        ? 'background:#f0f6ff;font-weight:600;'
                                        : ''"
                                @mouseenter="$el.style.background='#f9fafb'"
                                @mouseleave="$el.style.background=selected.includes(option.id)?'#f0f6ff':'transparent'"
                            >
                                <span x-text="option.label"></span>
                            </div>
                        </template>
                    </div>

                    <!-- hidden inputs -->
                    <template x-for="id in selected" :key="id">
                        <input type="hidden" name="pages[]" :value="id">
                    </template>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 24px;">
                    <button type="submit"
                            style="padding: 10px 24px; background: var(--primary); color: white; border: none; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer;">
                        حفظ
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                       style="padding: 10px 24px; background: var(--secondary); color: white; border-radius: 6px; font-size: 14px; font-weight: 500; text-decoration: none; display: inline-block;">
                        إلغاء
                    </a>
                </div>
            </form>
        </x-card>
    </div>
    <script>
        function multiSelect({options, selected}) {
            return {
                open: false,
                options,
                selected,

                get selectedItems() {
                    return this.options.filter(o => this.selected.includes(o.id))
                },

                toggle(id) {
                    if (this.selected.includes(id)) {
                        this.selected = this.selected.filter(i => i !== id)
                    } else {
                        this.selected.push(id)
                    }
                },

                remove(id) {
                    this.selected = this.selected.filter(i => i !== id)
                }
            }
        }
    </script>

</x-layout>
