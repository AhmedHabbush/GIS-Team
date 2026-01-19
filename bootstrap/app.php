<?php

use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\EnsureUserCanAccessPage;
use App\Http\Middleware\EnsureUserIsApproved;
use App\Http\Middleware\RedirectByRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'page.access' => EnsureUserCanAccessPage::class,
            'admin' => EnsureAdmin::class,
            'redirect.by.role' => RedirectByRole::class,
            'approved' => EnsureUserIsApproved::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
