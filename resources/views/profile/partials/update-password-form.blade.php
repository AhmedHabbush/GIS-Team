<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('تحديث كلمة المرور') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('تأكد من استخدام كلمة مرور طويلة وعشوائية لحماية حسابك.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- كلمة المرور الحالية -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('كلمة المرور الحالية')" />
            <div x-data="{ show: false }" class="relative mt-1">
                <input
                    :type="show ? 'text' : 'password'"
                    id="update_password_current_password"
                    name="current_password"
                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm pl-10"
                    autocomplete="current-password"
                    dir="rtl"
                >
                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 hover:text-gray-700"
                    tabindex="-1"
                >
                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.956 9.956 0 012.062-3.368m5.598 3.598A3 3 0 0015.477 9.477m0 0A3 3 0 0010.523 14.523M3 3l18 18"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- كلمة المرور الجديدة -->
        <div>
            <x-input-label for="update_password_password" :value="__('كلمة المرور الجديدة')" />
            <div x-data="{ show: false }" class="relative mt-1">
                <input
                    :type="show ? 'text' : 'password'"
                    id="update_password_password"
                    name="password"
                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm pl-10"
                    autocomplete="new-password"
                    dir="rtl"
                >
                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 hover:text-gray-700"
                    tabindex="-1"
                >
                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.956 9.956 0 012.062-3.368m5.598 3.598A3 3 0 0015.477 9.477m0 0A3 3 0 0010.523 14.523M3 3l18 18"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- تأكيد كلمة المرور -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('تأكيد كلمة المرور')" />
            <div x-data="{ show: false }" class="relative mt-1">
                <input
                    :type="show ? 'text' : 'password'"
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm pl-10"
                    autocomplete="new-password"
                    dir="rtl"
                >
                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 hover:text-gray-700"
                    tabindex="-1"
                >
                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.956 9.956 0 012.062-3.368m5.598 3.598A3 3 0 0015.477 9.477m0 0A3 3 0 0010.523 14.523M3 3l18 18"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('تحديث كلمة المرور') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium"
                >✓ {{ __('تم التحديث بنجاح') }}</p>
            @endif
        </div>
    </form>
</section>
