<?php

use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/about', function () {
    return view('about.about');
})->name('about');
Route::get('/privacy', function () {
    return view('privacy.privacy');
})->name('privacy');
Route::get('/terms', function () {
    return view('terms.terms');
})->name('terms');
Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create();

    // الصفحة الرئيسية
    $sitemap->add(Url::create('/')
        ->setLastModificationDate(now())
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        ->setPriority(1.0));

    // الصفحات الثابتة
    $sitemap->add(Url::create('/about')
        ->setLastModificationDate(now())
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
        ->setPriority(0.8));

    $sitemap->add(Url::create('/services')
        ->setLastModificationDate(now())
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
        ->setPriority(0.9));

    $sitemap->add(Url::create('/contact')
        ->setLastModificationDate(now())
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
        ->setPriority(0.6));

    return $sitemap->toResponse(request());
});
require __DIR__ . '/auth.php';
require __DIR__.'/user.php';
require __DIR__.'/admin.php';
