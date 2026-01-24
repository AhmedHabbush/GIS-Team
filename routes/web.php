<?php

use Illuminate\Support\Facades\Route;

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
require __DIR__ . '/auth.php';
require __DIR__.'/user.php';
require __DIR__.'/admin.php';
