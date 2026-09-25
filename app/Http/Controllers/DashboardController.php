<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Locker;
use App\Models\LockerUsage;
use App\Models\Maintenance;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboards.index', [
            'totalLocations' => Location::count(),
            'totalLockers' => Locker::count(),
            'availableLockers' => Locker::where('status', 'available')->count(),
            'inUseLockers' => Locker::where('status', 'in_use')->count(),
            'maintenanceLockers' => Locker::where('status', 'maintenance')->count(),
            'activeUsages' => LockerUsage::whereNull('release_at')->count(),
            'totalUsers' => User::where('role', 'user')->count(),
            'pendingMaintenance' => Maintenance::whereIn('status', ['pending', 'in_progress'])->count(),
            'recentMaintenance' => Maintenance::with('locker.location')->latest()->limit(5)->get(),
        ]);
    }

    public function userIndex()
    {
        return view('user.dashboard.index');
    }

    public function userIndex()
    {
        return view('user.dashboard.index');
    }
}
