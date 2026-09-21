<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Locker;
use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Location
        $locationTotal = Location::count();
        $locationTrend = Location::where('created_at', '>=', now()->subweek())->count();

        // Locker
        $lockerTotal = Locker::count();
        $lockerInUse = Locker::where('available', false)->count();
        $lockerFree = $lockerTotal - $lockerInUse;

        // User
        $userTotal = User::count();
        $userActive = Locker::where('available', false)->whereNotNull('user_id')->distinct('user_id')->count('user_id');

        // Maintenance
        $maintenanceOpen = Maintenance::where('close', false)->count();
        $stats = [
            [
                'label' => 'Total Locations',
                'value' => $locationTotal,
                'class_value' => 'text-brand',
                'trend' => '+' .  $locationTrend . " " . 'this week',
                'trend_icon' => 'fa-arrow-trend-up',
                'class_trend' => 'text-brand/80',
                'icon' => 'fa-location-dot',
                'class' => 'bg-brand/20 text-brand border border-brand/20',
            ],
            [
                'label' => 'Total Lockers',
                'value' => $lockerTotal,
                'class_value' => 'text-success-fg',
                'trend' => "{$lockerInUse} in use | {$lockerFree} free",
                'trend_icon' => 'fa-box',
                'class_trend' => 'text-success-fg/80',
                'icon' => 'fa-box',
                'class' => 'bg-success-bg text-success-fg border border-success-border/20',
            ],
            [
                'label' => 'Total Users',
                'value' => $userTotal,
                'class_value' => 'text-warning-fg',
                'trend' => "{$userActive} active now",
                'trend_icon' => 'fa-arrow-trend-up',
                'class_trend' => 'text-warning-fg/80',
                'icon' => 'fa-users',
                'class' => 'bg-warning-bg text-warning-fg border border-warning-border/20',
            ],
            [
                'label' => 'Open Issues',
                'value' => $maintenanceOpen,
                'class_value' => 'text-danger-fg',
                'trend' => $maintenanceOpen === 0 ? 'All clear' : "{$maintenanceOpen} need attention",
                'trend_icon' => $maintenanceOpen === 0 ? 'fa-circle-check' : 'fa-wrench',
                'class_trend' => 'text-danger-fg/80',
                'icon' => 'fa-triangle-exclamation',
                'class' => 'bg-danger-bg text-danger-fg border border-danger-border/20',
            ],
        ];

        return view('dashboards.index', compact('stats'));
    }
}
