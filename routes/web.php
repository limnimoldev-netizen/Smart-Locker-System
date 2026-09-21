<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/lockers', [LockerController::class, 'index'])->name('lockers.index');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');


