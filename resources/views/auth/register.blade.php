<x-guest-layout>
    <style>
        .input-icon {
            color: var(--text-secondary);
        }

        .auth-input, .auth-select {
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .auth-input:focus, .auth-select:focus {
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

        .profile-upload {
            border: 2px dashed var(--border);
            background: rgba(245, 241, 232, 0.3);
            transition: all 0.3s ease;
        }

        .profile-upload:hover {
            border-color: var(--primary);
            background: rgba(168, 137, 108, 0.1);
        }
    </style>

    <!-- عنوان الصفحة -->
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4"
             style="background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </div>
        <h3 class="text-2xl font-bold" style="color: var(--text-primary);">إنشاء حساب جديد</h3>
        <p class="text-sm mt-2" style="color: var(--text-secondary);">انضم إلى نظام البوابة الآن</p>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- الصورة الشخصية -->
        <div>
            <label class="block text-sm font-semibold mb-2" style="color: var(--text-primary);">
                الصورة الشخصية
            </label>
            <div x-data="{ preview: null }">
                <div class="flex items-center justify-center">
                    <label for="profile_image" class="cursor-pointer">
                        <div class="profile-upload relative w-24 h-24 rounded-full flex items-center justify-center overflow-hidden">
                            <template x-if="!preview">
                                <div class="text-center">
                                    <svg class="mx-auto h-8 w-8" style="color: var(--primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <p class="text-xs mt-1" style="color: var(--text-secondary);">اختر صورة</p>
                                </div>
                            </template>
                            <template x-if="preview">
                                <img :src="preview" class="w-full h-full object-cover" alt="معاينة">
                            </template>
                        </div>
                    </label>
                </div>
                <input type="file" id="profile_image" name="profile_image" accept="image/*" class="hidden"
                       @change="preview = URL.createObjectURL($event.target.files[0])">
            </div>
            @error('profile_image')
            <p class="mt-2 text-sm" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- الاسم -->
        <div>
            <label for="name" class="block text-sm font-semibold mb-2" style="color: var(--text-primary);">الاسم الثلاثي</label>
            <div class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <input id="name" class="auth-input block w-full pr-10 pl-4 py-2.5 rounded-xl text-sm" type="text" name="name"
                       value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="محمد أحمد علي"/>
            </div>
            @error('name')
            <p class="mt-1 text-sm" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- البريد الإلكتروني -->
        <div>
            <label for="email" class="block text-sm font-semibold mb-2" style="color: var(--text-primary);">البريد الإلكتروني</label>
            <div class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <input id="email" class="auth-input block w-full pr-10 pl-4 py-2.5 rounded-xl text-sm" type="email" name="email"
                       value="{{ old('email') }}" required autocomplete="username" placeholder="example@email.com"/>
            </div>
            @error('email')
            <p class="mt-1 text-sm" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- رقم الجوال -->
        <div>
            <label for="phone" class="block text-sm font-semibold mb-2" style="color: var(--text-primary);">رقم الجوال</label>
            <div class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <input id="phone" class="auth-input block w-full pr-10 pl-4 py-2.5 rounded-xl text-sm" type="tel" name="phone"
                       value="{{ old('phone') }}" required placeholder="0599123456"/>
            </div>
            @error('phone')
            <p class="mt-1 text-sm" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- الصلاحية -->
        <div>
            <label for="role_id" class="block text-sm font-semibold mb-2" style="color: var(--text-primary);">الصلاحية</label>
            <div class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <select id="role_id" name="role_id" required class="auth-select block w-full pr-10 pl-4 py-2.5 rounded-xl text-sm">
                    <option value="">اختر الصلاحية</option>
                    @foreach(\App\Models\Role::all() as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->display_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('role_id')
            <p class="mt-1 text-sm" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- كلمة المرور -->
        <div>
            <label for="password" class="block text-sm font-semibold mb-2" style="color: var(--text-primary);">كلمة المرور</label>
            <div x-data="{ show: false }" class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input :type="show ? 'text' : 'password'" name="password" id="password" required autocomplete="new-password"
                       class="auth-input block w-full pr-10 pl-12 py-2.5 rounded-xl text-sm" placeholder="••••••••" dir="rtl">
                <button type="button" @click="show = !show" class="absolute inset-y-0 left-0 pl-3 flex items-center transition"
                        style="color: var(--text-secondary);" tabindex="-1">
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
            <p class="mt-1 text-sm" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- تأكيد كلمة المرور -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold mb-2" style="color: var(--text-primary);">تأكيد كلمة المرور</label>
            <div x-data="{ show: false }" class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <input :type="show ? 'text' : 'password'" name="password_confirmation" id="password_confirmation" required
                       autocomplete="new-password" class="auth-input block w-full pr-10 pl-12 py-2.5 rounded-xl text-sm"
                       placeholder="••••••••" dir="rtl">
                <button type="button" @click="show = !show" class="absolute inset-y-0 left-0 pl-3 flex items-center transition"
                        style="color: var(--text-secondary);" tabindex="-1">
                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.956 9.956 0 012.062-3.368m5.598 3.598A3 3 0 0015.477 9.477m0 0A3 3 0 0010.523 14.523M3 3l18 18"/>
                    </svg>
                </button>
            </div>
            @error('password_confirmation')
            <p class="mt-1 text-sm" style="color: var(--danger);">{{ $message }}</p>
            @enderror
        </div>

        <!-- زر الإنشاء -->
        <div class="space-y-4 pt-2">
            <button type="submit" class="auth-button w-full text-white font-semibold py-3 px-4 rounded-xl">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    إنشاء الحساب
                </span>
            </button>

            <div class="text-center pt-2 border-t" style="border-color: var(--border);">
                <span class="text-sm" style="color: var(--text-secondary);">لديك حساب بالفعل؟</span>
                <a href="{{ route('login') }}" class="text-sm font-semibold mr-1 transition"
                   style="color: var(--primary);"
                   onmouseover="this.style.color='var(--primary-dark)'"
                   onmouseout="this.style.color='var(--primary)'">
                    سجّل الدخول
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
