<?php

namespace App\Providers;

use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Mendaftarkan middleware untuk role dan permission
        Route::aliasMiddleware('role', CheckRole::class);
        Route::aliasMiddleware('permission', CheckPermission::class);
    }
}