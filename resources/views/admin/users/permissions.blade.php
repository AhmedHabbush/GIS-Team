<x-layout>
    <x-slot:title>صلاحيات المستخدم</x-slot:title>

    <x-card>
        <x-slot:header>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold">
                        صلاحيات المستخدم
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ $user->name }} — {{ $user->email }}
                    </p>
                </div>

                <a href="{{ route('admin.users.index') }}"
                   class="text-sm text-gray-600 hover:text-gray-900 hover:underline">
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
                            border
                            rounded-xl
                            cursor-pointer
                            transition
                            hover:border-blue-500
                            hover:bg-blue-50
                        "
                    >
                        <input
                            type="checkbox"
                            name="permissions[]"
                            value="{{ $permission->id }}"
                            @checked($user->permissions->contains($permission))
                            class="mt-1 h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                        >

                        <div>
                            <div class="font-medium text-gray-800 group-hover:text-blue-700">
                                {{ $permission->display_name }}
                            </div>

                            <div class="text-xs text-gray-400 mt-0.5">
                                {{ $permission->key }}
                            </div>
                        </div>
                    </label>
                @endforeach

            </div>

            {{-- Actions --}}
            <div class="mt-8 flex justify-end">
                <x-button type="submit">
                    💾 حفظ الصلاحيات
                </x-button>
            </div>

        </form>
    </x-card>
</x-layout>
