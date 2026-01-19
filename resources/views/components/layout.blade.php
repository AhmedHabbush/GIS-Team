<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.svg" type="image/x-icon">
    <title>{{ $title ?? 'لوحة التحكم' }} - نظام البوابة</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Brown Color Palette */
            --primary: #8B6F47;
            --primary-dark: #6B5638;
            --primary-light: #A8896C;
            --secondary: #5D4E37;
            --success: #7D8F69;
            --danger: #A0522D;
            --warning: #D2691E;

            /* Backgrounds */
            --bg-light: #F5F1E8;
            --bg-white: #F2F3EB;
            --bg-card: #FEFDFB;

            /* Borders & Lines */
            --border: #D4C4A8;
            --border-light: #E8DCC8;

            /* Text Colors */
            --text-primary: #3E2F1F;
            --text-secondary: #6B5D4F;
            --text-muted: #8A7968;

            /* Layout */
            --sidebar-width: 280px;
            --topbar-height: 70px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-light);
            color: var(--text-primary);
            line-height: 1.6;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            margin-right: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrapper {
            flex: 1;
            padding: 32px;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-right: 0;
            }

            .content-wrapper {
                padding: 16px;
            }
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <x-admin.sidebar />

    <main class="main-content">
        <x-admin.topbar />

        <div class="content-wrapper">
            @if (session('success'))
                <x-alert type="success">{{ session('success') }}</x-alert>
            @endif

            @if (session('error'))
                <x-alert type="error">{{ session('error') }}</x-alert>
            @endif

            {{ $slot }}
        </div>
    </main>
</div>

@stack('scripts')
</body>
</html>
