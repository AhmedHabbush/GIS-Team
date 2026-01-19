<?php

use App\Http\Controllers\PortalPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\User\DocumentFileController;
use App\Http\Controllers\User\IframeController;
use App\Http\Controllers\User\IframeDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'approved', 'verified', 'redirect.by.role'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('user.dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Documents
    Route::controller(DocumentController::class)->group(function () {
        Route::get('/documents', 'index')->name('documents.index');
        Route::get('/documents/create', 'create')->name('documents.create');
        Route::post('/documents', 'store')->name('documents.store');
        Route::delete('/documents/{document}', 'destroy')->name('documents.destroy');
        Route::get('/documents/{document}/print', 'print')->middleware('can:print,document')
            ->name('documents.print');
    });

    Route::get('/document-files/{documentFile}/download',[DocumentController::class, 'download'])->name('documents.download');

    Route::delete('/document-files/{documentFile}',[DocumentFileController::class, 'destroy'])->name('documents.files.destroy');

    Route::name('iframe.')->group(function () {
        Route::get('/portal', [IframeController::class, 'show'])->name('show');
        Route::get('/iframes/dashboard', [IframeDashboardController::class, 'show'])->name('dashboard');
    });

    // Portal pages
    Route::get('/p/{slug}', [PortalPageController::class, 'show'])
        ->middleware('page.access')
        ->name('portal.pages.show');
});
