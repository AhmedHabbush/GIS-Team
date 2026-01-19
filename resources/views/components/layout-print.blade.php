<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: cairo;
            direction: rtl;
            text-align: right;
            font-size: 14px;
            color: #333;
        }

        h1, h2, h3 {
            margin: 0;
            color: #222;
        }

        .title {
            text-align: center;
            margin: 30px 0 20px;
            font-size: 22px;
            font-weight: bold;
        }

        .section {
            margin-bottom: 20px;
        }

        .box {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 15px;
            background: #fafafa;
        }

        .row {
            margin-bottom: 6px;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 13px;
        }

        th {
            background: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
{{ $slot }}
</body>
</html>
