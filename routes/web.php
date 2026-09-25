<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\UserAccess;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// Guest only
Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'show'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store');

    Route::get('/register', [RegisterController::class, 'show'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');

    Route::get('/forgot-password', fn () => 'Forgot password page coming soon')
        ->name('password.request');
});

// Logged in only
Route::middleware('auth')->group(function () {

    Route::middleware(AdminAccess::class)->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('locations', LocationController::class)->except('destroy');
        Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');

        Route::resource('lockers', LockerController::class)->except('destroy');
        Route::delete('/lockers/{locker}', [LockerController::class, 'destroy'])->name('lockers.destroy');

        Route::resource('users', UserController::class)->except('show');

        Route::resource('maintenance', MaintenanceController::class)->except('destroy');
        Route::delete('/maintenance/{maintenance}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');
    });

    Route::middleware(UserAccess::class)->group(function () {
        Route::get('/user/dashboard', [DashboardController::class, 'userIndex'])->name('user.dashboard');
        Route::get('/user/locations', [LocationController::class, 'userIndex'])->name('user.locations.index');
        Route::get('/user/lockers', [LockerController::class, 'userIndex'])->name('user.lockers.index');
        Route::get('/user/usage', [LockerUsageController::class, 'index'])->name('user.usage.index');
        Route::view('/user/profile', 'user.profile.index')->name('user.profile');
    });

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');
});