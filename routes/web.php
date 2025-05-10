<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Default Root URL
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Redirect the root URL to Login
Route::redirect('/', '/login')->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Settings Routes
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Users Routes
    Route::get('users', Users\Index::class)->name('users.index');

});

require __DIR__.'/auth.php';
