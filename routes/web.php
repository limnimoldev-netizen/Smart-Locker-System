<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\UserAccess;

Route::redirect('/', '/register');

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

    Route::middleware(UserAccess::class)->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'userIndex'])->name('dashboard');
        Route::get('/locations', [LocationController::class, 'userIndex'])->name('locations.index');
        Route::get('/locations/{location}', [LocationController::class, 'userShow'])->name('locations.show');
        Route::get('/locations/{location}/lockers', [LocationController::class, 'lockers'])->name('locations.lockers');
        Route::get('/lockers', [LockerController::class, 'userIndex'])->name('lockers.index');
        Route::get('/lockers/{locker}/confirm', [LockerController::class, 'confirm'])->name('lockers.confirm');
        Route::post('/lockers/{locker}/confirm', [LockerController::class, 'startUsage'])->name('lockers.confirm.store');
        Route::get('/usage', [LockerUsageController::class, 'index'])->name('usage.index');
        Route::get('/locker-usages/{lockerUsage}', [LockerUsageController::class, 'show'])->name('usage.show');
        Route::patch('/locker-usages/{lockerUsage}/release', [LockerUsageController::class, 'release'])->name('locker-usages.release');
        
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');
});
