<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Locker;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function search()
    {
        $locations = Location::withCount(['lockers as free_count' => function ($q) {
            $q->where('status', 'available');
        }])->get();

        return view('user.locations.search', compact('locations'));
    }

    public function userShow(Location $location)
    {
        $lockers = $location->lockers;

        $available = $lockers->where('status', 'available')->count();
        $inUse = $lockers->where('status', 'in_use')->count();
        $maintenance = $lockers->where('status', 'maintenance')->count();

        return view('user.locations.show', compact('location', 'available', 'inUse', 'maintenance'));
    }

    public function lockers(Location $location)
    {
        $lockers = $location->lockers()->orderBy('locker_number')->get();

        return view('user.locations.lockers', compact('location', 'lockers'));
    }

    public function index()
    {
        $locations = Location::withCount('lockers')->get();
        $totalLocations = Location::count();
        $activeLocations = Location::where('status', 'active')->count();
        $totalLockers = Locker::count();

        return view('locations.index', compact('locations', 'totalLocations', 'activeLocations', 'totalLockers'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'map_url' => ['nullable', 'url', 'max:5000'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        Location::create($validated);

        return redirect()->route('locations.index');
    }

    public function show($id)
    {
        $location = Location::findOrFail($id);

        return view('locations.show', compact('location'));
    }

    public function edit($id)
    {
        $location = Location::findOrFail($id);

        return view('locations.edite', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'map_url' => ['nullable', 'url', 'max:5000'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $location = Location::findOrFail($id);
        $location->update($validated);

        return redirect()->route('locations.show', $location);
    }

    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('locations.index');
    }

    public function userIndex()
    {
        $locations = Location::withCount(['lockers as free_count' => function ($q) {
            $q->where('status', 'available');
        }])->get();

        return view('user.locations.search', compact('locations'));
    }

}
