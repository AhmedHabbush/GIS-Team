<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('معلومات الحساب') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("تحديث الاسم والبريد الإلكتروني والصورة الشخصية") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- الصورة الشخصية -->
        <div x-data="{ preview: '{{ $user->profile_image_url ?? '' }}' }">
            <x-input-label for="profile_image" :value="__('الصورة الشخصية')" />

            <div class="mt-3 flex items-center gap-6">
                <!-- Preview -->
                <div class="relative">
                    <template x-if="preview">
                        <img :src="preview" class="w-24 h-24 rounded-full object-cover border-3 border-gray-200 shadow-md" alt="Profile">
                    </template>
                    <template x-if="!preview">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-purple-600 to-indigo-600 flex items-center justify-center text-white text-2xl font-bold border-3 border-gray-200 shadow-md">
                            {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                        </div>
                    </template>
                </div>

                <!-- Upload Button -->
                <div class="flex-1">
                    <label for="profile_image" class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        اختر صورة جديدة
                    </label>
                    <input
                        type="file"
                        id="profile_image"
                        name="profile_image"
                        accept="image/*"
                        class="hidden"
                        @change="preview = URL.createObjectURL($event.target.files[0])"
                    >
                    <p class="mt-2 text-xs text-gray-500">JPG, PNG أو GIF (الحد الأقصى 2MB)</p>

                    @if($user->profile_image)
                        <label class="mt-2 inline-flex items-center">
                            <input type="checkbox" name="remove_profile_image" value="1" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500">
                            <span class="mr-2 text-sm text-red-600">حذف الصورة الحالية</span>
                        </label>
                    @endif
                </div>
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
        </div>

        <!-- الاسم -->
        <div>
            <x-input-label for="name" :value="__('الاسم')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- البريد الإلكتروني -->
        <div>
            <x-input-label for="email" :value="__('البريد الإلكتروني')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- رقم الهاتف -->
        <div>
            <x-input-label for="phone" :value="__('رقم الهاتف')" />
            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('حفظ التغييرات') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium"
                >✓ {{ __('تم الحفظ بنجاح') }}</p>
            @endif
        </div>
    </form>
</section>
