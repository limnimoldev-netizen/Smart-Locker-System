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
    public function index(Request $request)
    {
        // Location
        $locationTotal = Location::count();
        $locationTrend = Location::where('created_at', '>=', now()->subweek())->count();

        // Locker
        $lockerTotal = Locker::count();
        $lockerInUse = Locker::where('status', 'available')->count();
        $lockerFree = $lockerTotal - $lockerInUse;

        // User
        $userTotal = User::count();
        $userActive = User::where('status', 'Active')->count();

        // Maintenance
        $maintenanceOpen = Maintenance::where('status', 'open')->count();
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

        $query = Locker::with(['location', 'user']);

        // Search by Locker Code, Locker ID, or Location Name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('locker_code', 'like', "%{$search}%")
                ->orWhere('locker_id', 'like', "%{$search}%")
                ->orWhereHas('location', function($locQuery) use ($search) {
                    // FIXED: Using 'location_name' to match your database
                    $locQuery->where('location_name', 'like', "%{$search}%"); 
                });
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status); // Values are already lowercase from the form
        }

        // Paginate and preserve URL query strings
        $dataLockers = $query->paginate(10)->withQueryString();

        return view('dashboards.index', compact('stats', 'dataLockers'));
    }
}
