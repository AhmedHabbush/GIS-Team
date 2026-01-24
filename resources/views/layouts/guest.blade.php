<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.svg" type="image/x-icon">
    <title>{{ config('app.name', 'نظام البوابة') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #8B6F47;
            --primary-dark: #6B5638;
            --primary-light: #A8896C;
            --bg-light: #F5F1E8;
            --bg-white: #F2F3EB;
            --border: #D4C4A8;
            --text-primary: #3E2F1F;
            --text-secondary: #6B5D4F;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .auth-gradient {
            background: linear-gradient(135deg, #F5F1E8 0%, #E8DCC8 50%, #D4C4A8 100%);
            position: relative;
            overflow: hidden;
        }

        .auth-gradient::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(139, 111, 71, 0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-5%, -5%) scale(1.1); }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 196, 168, 0.3);
            box-shadow: 0 8px 32px rgba(62, 47, 31, 0.15);
        }

        .topbar-auth {
            background: linear-gradient(135deg, var(--bg-white) 0%, #E8DCC8 100%);
            border-bottom: 2px solid var(--border);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(62, 47, 31, 0.1);
        }

        .logo-container {
            background: var(--bg-white);
            border: 2px solid var(--border);
            box-shadow: 0 2px 8px rgba(139, 111, 71, 0.15);
            transition: transform 0.2s;
        }

        .logo-container:hover {
            transform: scale(1.05);
        }

        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .topbar-title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
            white-space: nowrap;
            letter-spacing: 0.5px;
        }

        /* تمييز بين صفحات Auth وصفحات المحتوى */
        .content-wrapper {
            width: 100%;
            max-width: 1200px; /* عرض أكبر للصفحات */
            position: relative;
            z-index: 10;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 28rem; /* 448px - للـ Login/Register */
            position: relative;
            z-index: 10;
        }

        @media (max-width: 768px) {
            .topbar-auth {
                padding: 1rem;
            }

            .content-wrapper,
            .auth-wrapper {
                margin: 1rem;
            }

            .topbar-title {
                font-size: 18px;
            }

            .logo-container {
                width: 40px !important;
                height: 40px !important;
            }
        }

        @media (max-width: 640px) {
            .topbar-title {
                font-size: 16px;
            }
        }
    </style>
</head>
<body class="antialiased">
<!-- Top Bar -->
<header class="topbar-auth fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-center h-20 relative">
            <!-- Logo - اليمين -->
            <div class="absolute right-0 flex items-center gap-4">
                <div class="logo-container rounded-xl flex items-center justify-center p-2">
                    {{--<img src="{{ asset('images/logo.png') }}" alt="Logo">--}}
                    GIS Team
                </div>
            </div>

            <!-- Title - الوسط -->
            <h1 class="topbar-title">GIS Team</h1>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="min-h-screen flex items-center justify-center auth-gradient pt-24 pb-12 px-4 relative">
    @php
        // تحديد الصفحات التي تحتاج عرض أكبر
        $widePages = ['about', 'privacy', 'terms'];
        $currentRoute = Route::currentRouteName();
        $isWidePage = in_array($currentRoute, $widePages);
    @endphp

        <!-- Dynamic Wrapper بناءً على نوع الصفحة -->
    <div class="{{ $isWidePage ? 'content-wrapper' : 'auth-wrapper' }}">
        <div class="glass-effect rounded-2xl shadow-2xl p-6 sm:p-8">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <footer class="mt-12 py-6 border-t" style="border-color: var(--border);">
                <div class="max-w-7xl mx-auto px-4 text-center">
                    <div class="flex justify-center gap-6 mb-4 flex-wrap">
                        <a href="{{ route('about') }}" class="text-sm hover:underline transition-colors" style="color: var(--text-secondary);">من نحن</a>
                        <a href="{{ route('privacy') }}" class="text-sm hover:underline transition-colors" style="color: var(--text-secondary);">سياسة الخصوصية</a>
                        <a href="{{ route('terms') }}" class="text-sm hover:underline transition-colors" style="color: var(--text-secondary);">شروط الاستخدام</a>
                    </div>
                    <p class="text-sm" style="color: var(--text-secondary);">
                        © {{ date('Y') }} جميع الحقوق محفوظة . GIS Team
                    </p>
                </div>
            </footer>
        </div>
    </div>
</div>
</body>
</html>
