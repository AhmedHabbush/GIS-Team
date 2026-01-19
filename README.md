# Access Portal System

نظام بوابة لإدارة المستندات والصلاحيات.

## المتطلبات
- PHP ^8.2
- Composer
- Node.js + npm
- MySQL

## خطوات التشغيل

1. فك الضغط عن المشروع
2. أنشئ ملف `.env`
3. انسخ محتوى `.env.example` إلى `.env`
4. عدّل بيانات قاعدة البيانات
5. شغّل الأوامر التالية:

```bash
composer install
npm install
npm run build
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan optimize:clear
