<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\MaintenanceController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/user/dashboard', [DashboardController::class, 'userIndex'])->name('user.dashboard');

Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');

Route::get('/lockers', [LockerController::class, 'index'])->name('lockers.index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
Route::get('/user/locations', [LocationController::class, 'userIndex'])->name('user.locations.index');
Route::get('/user/lockers', [LockerController::class, 'userIndex'])->name('user.lockers.index');
Route::get('/user/usage', [LockerUsageController::class, 'index'])->name('user.usage.index');

Route::middleware('auth')->prefix('user')->group(function () {
Route::get('/profile', [UserController::class, 'index'])->name('profile.show');
Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
});
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');