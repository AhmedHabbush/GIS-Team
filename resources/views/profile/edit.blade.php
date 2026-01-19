<x-layout>
    <style>
        .user-avatar-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e5e7eb;
        }

        .user-avatar-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
            border: 2px solid #e5e7eb;
        }
    </style>
    <x-slot:title>الملف الشخصي</x-slot:title>

    {{-- Header --}}
    <div
        style="
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 32px;
            border-radius: 12px;
            margin-bottom: 32px;
        "
    >
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-bold mb-1">
                    الملف الشخصي
                </h1>
                <p class="text-sm opacity-90">
                    إدارة معلومات حسابك وأمانه
                </p>
            </div>

            <div
                class="flex items-center gap-3 bg-white/20 px-4 py-2 rounded-lg backdrop-blur"
            >
                <div
                    class="w-10 h-10 text-primary flex items-center justify-center font-bold"
                >
                    <!-- Avatar -->
                    @if(auth()->user()->profile_image)
                        <img
                            src="{{ auth()->user()->profile_image_url }}"
                            alt="{{ auth()->user()->name }}"
                            class="user-avatar-img"
                        >
                    @else
                        <div class="user-avatar-placeholder">
                            <img src="{{ asset('images/default-avatar.png') }}" alt="{{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}">
                        </div>
                    @endif
                </div>

                <div class="text-sm">
                    <div class="font-semibold">{{ auth()->user()->name }}</div>
                    <div class="opacity-80">
                        {{ auth()->user()->role->display_name ?? 'مستخدم' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- ================= Profile Info ================= --}}
        <x-card>
            <x-slot:header>
                <h2 class="text-lg font-semibold flex items-center gap-2">
                    🧾 المعلومات الشخصية
                </h2>
            </x-slot:header>

            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </x-card>

        {{-- ================= Password ================= --}}
        <x-card>
            <x-slot:header>
                <h2 class="text-lg font-semibold flex items-center gap-2">
                    🔐 تغيير كلمة المرور
                </h2>
            </x-slot:header>

            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </x-card>

        {{-- ================= Danger Zone ================= --}}
        <x-card>
            <x-slot:header>
                <h2 class="text-lg font-semibold flex items-center gap-2 text-red-600">
                    ⚠️ منطقة خطرة
                </h2>
            </x-slot:header>

            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </x-card>

    </div>
</x-layout>
