<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDocumentController;
use App\Http\Controllers\Admin\AdminDocumentFileController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminUserPermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin', 'redirect.by.role'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Users
        Route::controller(AdminUserController::class)->group(function () {
            Route::get('pending', 'pending')->name('users.pending');
            Route::patch('users/{user}/approve', 'approve')->name('users.approve');

            Route::get('users/import', 'importForm')->name('users.import');
            Route::post('users/import/preview', 'importPreview')->name('users.import.preview');
            Route::post('users/import/store', 'importStore')->name('users.import.store');
        });

        Route::resource('users', AdminUserController::class);
        Route::resource('roles', AdminRoleController::class);
        Route::resource('pages', AdminPageController::class);

        // Profile
        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('profile', 'edit')->name('profile.edit');
            Route::patch('profile', 'update')->name('profile.update');
        });

        // Permissions
        Route::get('users/{user}/permissions',[AdminUserPermissionController::class, 'edit'])->name('users.permissions.edit');

        Route::put('users/{user}/permissions',[AdminUserPermissionController::class, 'update'])->name('users.permissions.update');

        // Documents
        Route::controller(AdminDocumentController::class)->group(function () {
            Route::get('documents', 'index')->name('documents.index');
            Route::get('documents/create', 'create')->name('documents.create');
            Route::post('documents', 'store')->name('documents.store');
            Route::delete('documents/{document}', 'destroy')->name('documents.destroy');
            Route::get('documents/{document}/download', 'download')->name('documents.download');
            Route::get('documents/{document}/print', 'print')->name('documents.print');
        });

        Route::controller(AdminDocumentFileController::class)->group(function () {
            Route::post('documents/{document}/files', 'store')->name('document-files.store');
            Route::get('document-files/{documentFile}/download', 'download')->name('document-files.download');
            Route::delete('document-files/{documentFile}', 'destroy')->name('document-files.destroy');
        });
    });
