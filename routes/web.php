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

// Logged-in users only
Route::middleware('auth')->group(function () {

    Route::middleware(AdminAccess::class)->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
        Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
        Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
        Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.show');
        Route::get('/locations/{location}/edit', [LocationController::class, 'edit'])->name('locations.edit');
        Route::put('/locations/{location}', [LocationController::class, 'update'])->name('locations.update');
        Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');

        Route::get('/lockers', [LockerController::class, 'index'])->name('lockers.index');
        Route::get('/lockers/create', [LockerController::class, 'create'])->name('lockers.create');
        Route::post('/lockers', [LockerController::class, 'store'])->name('lockers.store');
        Route::get('/lockers/{locker}', [LockerController::class, 'show'])->name('lockers.show');
        Route::get('/lockers/{locker}/edit', [LockerController::class, 'edit'])->name('lockers.edit');
        Route::put('/lockers/{locker}', [LockerController::class, 'update'])->name('lockers.update');
        Route::delete('/lockers/{locker}', [LockerController::class, 'destroy'])->name('lockers.destroy');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
        Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
        Route::get('/maintenance/{maintenance}', [MaintenanceController::class, 'show'])->name('maintenance.show');
        Route::get('/maintenance/{maintenance}/edit', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
        Route::put('/maintenance/{maintenance}', [MaintenanceController::class, 'update'])->name('maintenance.update');
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