<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// جدولة توليد الـ Sitemap يومياً عند الساعة 3 صباحاً
Schedule::command('sitemap:generate')->dailyAt('03:00');
