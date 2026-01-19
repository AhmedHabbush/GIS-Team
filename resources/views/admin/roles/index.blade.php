<x-layout>
    <x-slot:title>إدارة الصلاحيات</x-slot:title>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2 style="font-size: 20px; font-weight: 600;">قائمة الصلاحيات</h2>
        <x-button href="{{ route('admin.roles.create') }}" type="primary">
            <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
            </svg>
            إضافة صلاحية جديدة
        </x-button>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
        @foreach($roles as $role)
            @php
                $users = $role->users;
            @endphp
            <div style="background: var(--bg-white); border: 1px solid var(--border); border-radius: 8px; padding: 24px; position: relative;">
                <div style="width: 48px; height: 48px; border-radius: 8px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <svg style="width: 24px; height: 24px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"/>
                        <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                    </svg>
                </div>

                <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 8px; color: var(--text-primary);">
                    {{ $role->display_name }}
                </h3>

                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 20px; color: var(--text-secondary); font-size: 14px;">
                    <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                    <span
                        style="cursor: pointer; text-decoration: underline;"
                        x-data
                        x-on:click="$dispatch('open-modal', 'role-users-{{ $role->id }}')"
                    >
                        {{ $role->users_count }} مستخدم
                    </span>
                </div>

                <div style="display: flex; gap: 8px;">
                    <a href="{{ route('admin.roles.edit', $role) }}"
                       style="flex: 1; padding: 8px 16px; background: var(--primary); color: white; border-radius: 6px; font-size: 13px; text-decoration: none; text-align: center; font-weight: 500;">
                        تعديل
                    </a>
                    <form method="POST" action="{{ route('admin.roles.destroy', $role) }}"
                          onsubmit="return confirm('هل أنت متأكد من حذف هذه الصلاحية؟')"
                          style="flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="width: 100%; padding: 8px 16px; background: var(--danger); color: white; border: none; border-radius: 6px; font-size: 13px; cursor: pointer; font-weight: 500;">
                            حذف
                        </button>
                    </form>
                </div>
            </div>
            <x-modal name="role-users-{{ $role->id }}" maxWidth="lg">
                <div class="p-6 max-h-[70vh] overflow-y-auto">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <h3 style="font-size: 16px; font-weight: 600;">
                            المستخدمون – {{ $role->display_name }}
                        </h3>

                        <button
                            x-on:click="$dispatch('close-modal', 'role-users-{{ $role->id }}')"
                            style="font-size: 20px; color: #999;"
                        >
                            &times;
                        </button>
                    </div>

                    @if($role->users->count())
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            @foreach($role->users as $user)
                                <div style="padding: 12px; border: 1px solid var(--border); border-radius: 6px;">
                                    <div style="font-weight: 500;">{{ $user->name }}</div>
                                    <div style="font-size: 13px; color: var(--text-secondary);">
                                        {{ $user->email }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="color: var(--text-secondary); font-size: 14px;">
                            لا يوجد مستخدمون مرتبطون بهذه الصلاحية
                        </div>
                    @endif

                    <div style="margin-top: 20px; text-align: right;">
                        <x-button
                            variant="secondary"
                            x-on:click="$dispatch('close-modal', 'role-users-{{ $role->id }}')"
                            type="button"
                        >
                            إغلاق
                        </x-button>
                    </div>
                </div>
            </x-modal>
        @endforeach
    </div>
</x-layout>
