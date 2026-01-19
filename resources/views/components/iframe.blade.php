@props(['title'])

    <!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.svg" type="image/x-icon">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>{{ $title }}</title>

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: visible;
            background: #fff;
            font-family: inherit;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
            display: block;
            background: transparent;
        }
        iframe::-webkit-scrollbar {
            width: 0;
        }
    </style>
</head>
<body>
{{ $slot }}
</body>
</html>
