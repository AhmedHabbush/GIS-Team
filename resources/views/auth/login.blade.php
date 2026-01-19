<x-guest-layout>
    <style>
        .input-icon {
            color: var(--text-secondary);
        }

        .auth-input {
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .auth-input:focus {
            outline: none;
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(139, 111, 71, 0.1);
        }

        .auth-button {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            box-shadow: 0 4px 15px rgba(139, 111, 71, 0.3);
            transition: all 0.3s ease;
        }

        .auth-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 111, 71, 0.4);
        }

        .auth-button:active {
            transform: translateY(0);
        }

        .status-message {
            background: linear-gradient(135deg, rgba(168, 137, 108, 0.1) 0%, rgba(139, 111, 71, 0.1) 100%);
            border: 1px solid var(--border);
            color: var(--text-primary);
        }
    </style>

    <!-- عنوان الصفحة -->
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4"
             style="background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
        </div>
        <h3 class="text-2xl font-bold" style="color: var(--text-primary);">تسجيل الدخول</h3>
        <p class="text-sm mt-2" style="color: var(--text-secondary);">مرحباً بك مجدداً في نظام البوابة</p>
    </div>

    <!-- رسالة الحالة -->
    @if (session('status'))
        <div class="mb-6 status-message px-4 py-3 rounded-xl text-center text-sm shadow-sm">
            <svg class="inline-block w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- البريد الإلكتروني -->
        <div>
            <label for="email" class="block text-sm font-semibold mb-2" style="color: var(--text-primary);">
                البريد الإلكتروني
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <input id="email"
                       class="auth-input block w-full pr-10 pl-4 py-3 rounded-xl text-sm"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       autocomplete="username"
                       placeholder="example@email.com"/>
            </div>
            @error('email')
            <p class="mt-2 text-sm" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- كلمة المرور -->
        <div>
            <label for="password" class="block text-sm font-semibold mb-2" style="color: var(--text-primary);">
                كلمة المرور
            </label>
            <div x-data="{ show: false }" class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input
                    :type="show ? 'text' : 'password'"
                    name="password"
                    id="password"
                    required
                    autocomplete="current-password"
                    class="auth-input block w-full pr-10 pl-12 py-3 rounded-xl text-sm"
                    placeholder="••••••••"
                    dir="rtl"
                >
                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 left-0 pl-3 flex items-center transition"
                    style="color: var(--text-secondary);"
                    onmouseover="this.style.color='var(--text-primary)'"
                    onmouseout="this.style.color='var(--text-secondary)'"
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
            @error('password')
            <p class="mt-2 text-sm" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- تذكرني -->
        <div class="flex items-center">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me"
                       type="checkbox"
                       class="rounded border-gray-300 shadow-sm focus:ring-2 cursor-pointer"
                       style="color: var(--primary); border-color: var(--border);"
                       name="remember">
                <span class="mr-2 text-sm" style="color: var(--text-secondary);">تذكّرني</span>
            </label>
        </div>

        <!-- زر تسجيل الدخول -->
        <div class="space-y-4 pt-2">
            <button type="submit" class="auth-button w-full text-white font-semibold py-3 px-4 rounded-xl">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    تسجيل الدخول
                </span>
            </button>

            <div class="text-center pt-2 border-t" style="border-color: var(--border);">
                <span class="text-sm" style="color: var(--text-secondary);">ليس لديك حساب؟</span>
                <a href="{{ route('register') }}" class="text-sm font-semibold mr-1 transition"
                   style="color: var(--primary);"
                   onmouseover="this.style.color='var(--primary-dark)'"
                   onmouseout="this.style.color='var(--primary)'">
                    سجّل الآن
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
