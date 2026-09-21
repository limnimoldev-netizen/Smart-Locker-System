<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/user/dashboard', [DashboardController::class, 'userIndex'])->name('user.dashboard');

Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
Route::get('/locations/edit', [LocationController::class, 'edit'])->name('locations.edit');
Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');


Route::get('/lockers', [LockerController::class, 'index'])->name('lockers.index');
Route::get('/lockers/create', [LockerController::class, 'create'])->name('lockers.create');
Route::get('/lockers/edit', [LockerController::class, 'edit'])->name('lockers.edit');
Route::get('/lockers/show', [LockerController::class, 'show'])->name('lockers.show');


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
Route::get('/user/locations', [LocationController::class, 'userIndex'])->name('user.locations.index');
Route::get('/user/lockers', [LockerController::class, 'userIndex'])->name('user.lockers.index');
Route::get('/user/usage', [LockerUsageController::class, 'index'])->name('user.usage.index');

Route::get('/user/profile', function () {
    return view('user.profile.index');
})->name('user.profile');


