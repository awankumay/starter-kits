<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Default Root URL
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Redirect the root URL to Login
Route::redirect('/', '/login')->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', App\Livewire\Dashboard::class)->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Settings Routes
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Roles & Permissions Administration
    Route::middleware(['role:administrator'])->group(function () {

        // Users Management
        Route::redirect('users', 'users/index');
        Volt::route('users', 'users.index')->name('users.index');

        // Permissions Management
        Route::redirect('permissions', 'users-management/permissions');
        Volt::route('permissions', 'users-management.permissions')->name('users-management.permissions');

        // Roles Management
        Route::redirect('roles', 'users-management/roles');
        Volt::route('roles', 'users-management.roles')->name('users-management.roles');

        Route::redirect('unit-types', 'unit-types/index');
        Volt::route('unit-types', 'unit-types.index')->name('unit-types.index');

        Route::redirect('units', 'units/index');
        Volt::route('units', 'units.index')->name('units.index');

        Route::redirect('fuel', 'fuel/index');
        Volt::route('fuel', 'fuel.index')->name('fuel.index');

    });

});

require __DIR__.'/auth.php';
