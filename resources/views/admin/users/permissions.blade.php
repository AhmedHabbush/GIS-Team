<x-layout>
    <x-slot:title>صلاحيات المستخدم</x-slot:title>

    <x-card>
        <x-slot:header>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold" style="color: var(--text-primary);">
                        صلاحيات المستخدم
                    </h2>
                    <p class="text-sm" style="color: var(--text-muted);">
                        {{ $user->name }} — {{ $user->email }}
                    </p>
                </div>

                <a href="{{ route('admin.users.index') }}"
                   class="text-sm inline-flex items-center gap-2 px-4 py-2 rounded-lg transition-all"
                   style="color: var(--text-secondary); border: 1px solid var(--border); background: var(--bg-white);"
                   onmouseover="this.style.background='var(--primary-light)'; this.style.color='white'; this.style.borderColor='var(--primary-light)';"
                   onmouseout="this.style.background='var(--bg-white)'; this.style.color='var(--text-secondary)'; this.style.borderColor='var(--border)';">
                    ← رجوع للمستخدمين
                </a>
            </div>
        </x-slot:header>

        <form
            method="POST"
            action="{{ route('admin.users.permissions.update', $user) }}"
        >
            @csrf
            @method('PUT')

            {{-- Permissions Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                @foreach($permissions as $permission)
                    <label
                        class="
                            group
                            flex items-start gap-3
                            p-4
                            rounded-xl
                            cursor-pointer
                            transition-all
                            duration-200
                        "
                        style="border: 2px solid var(--border-light); background: var(--bg-card);"
                        onmouseover="this.style.borderColor='var(--primary)'; this.style.background='var(--bg-light)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(139, 111, 71, 0.15)';"
                        onmouseout="this.style.borderColor='var(--border-light)'; this.style.background='var(--bg-card)'; this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    >
                        <input
                            type="checkbox"
                            name="permissions[]"
                            value="{{ $permission->id }}"
                            @checked($user->permissions->contains($permission))
                            class="mt-1 h-5 w-5 rounded transition-all cursor-pointer"
                            style="
                                border: 2px solid var(--border);
                                accent-color: var(--primary);
                            "
                            onchange="this.checked ? this.parentElement.style.borderColor='var(--primary)' : this.parentElement.style.borderColor='var(--border-light)';"
                        >

                        <div class="flex-1">
                            <div class="font-semibold transition-colors" style="color: var(--text-primary);">
                                {{ $permission->display_name }}
                            </div>

                            <div class="text-xs mt-1 font-mono px-2 py-0.5 rounded inline-block"
                                 style="background: var(--bg-light); color: var(--text-muted);">
                                {{ $permission->key }}
                            </div>
                        </div>
                    </label>
                @endforeach

            </div>

            {{-- Actions --}}
            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}"
                   class="px-6 py-2.5 rounded-lg font-medium transition-all"
                   style="background: var(--bg-white); color: var(--text-secondary); border: 2px solid var(--border);"
                   onmouseover="this.style.background='var(--bg-light)';"
                   onmouseout="this.style.background='var(--bg-white)';">
                    إلغاء
                </a>

                <button
                    type="submit"
                    class="px-6 py-2.5 rounded-lg font-medium transition-all inline-flex items-center gap-2"
                    style="background: var(--primary); color: white; border: 2px solid var(--primary);"
                    onmouseover="this.style.background='var(--primary-dark)'; this.style.borderColor='var(--primary-dark)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(139, 111, 71, 0.3)';"
                    onmouseout="this.style.background='var(--primary)'; this.style.borderColor='var(--primary)'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    <span>💾</span>
                    <span>حفظ الصلاحيات</span>
                </button>
            </div>

        </form>
    </x-card>
</x-layout>
