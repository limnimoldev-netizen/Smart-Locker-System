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
    public function userIndex()
    {
        return view('user.dashboard.index');
    }

    public function index(Request $request)
    {
        // Location
        $locationTotal = Location::count();
        $locationTrend = Location::where('created_at', '>=', now()->subweek())->count();

        // Locker
        $lockerTotal = Locker::count();
        $lockerFree = Locker::where('status', 'available')->count();
        $lockerInUse = Locker::whereIn('status', ['in_use', 'occupied', 'reserved'])->count();

        // User
        $userTotal = User::count();
        $userActive = User::where('created_at', '>=', now()->subDays(30))->count();
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
                'trend' => "{$lockerFree} available | {$lockerInUse} in use",
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

        $query = Locker::query()
            ->leftJoin('locations', 'locations.id', '=', 'lockers.location_id')
            ->select('lockers.*', 'locations.name as dashboard_location_name', 'locations.address as dashboard_location_address');

        // Search by locker number, locker ID, or location name.
        if ($request->filled('search')) {
            $search = '%' . $request->string('search')->trim() . '%';
            $query->where(function ($query) use ($search) {
                $query->where('lockers.locker_number', 'like', $search)
                    ->orWhereRaw('CAST(lockers.id AS TEXT) ILIKE ?', [$search])
                    ->orWhere('locations.name', 'ilike', $search);
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('lockers.status', $request->status);
        }

        // Paginate and preserve URL query strings
        $dataLockers = $query->orderByDesc('lockers.created_at')->paginate(10)->withQueryString();

        return view('dashboards.index', compact('stats', 'dataLockers'));
    }
}
