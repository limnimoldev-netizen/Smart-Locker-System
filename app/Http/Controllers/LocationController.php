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
        $name = $request->input('name');
        $address = $request->input('address');
        $map_url = $request->input('map_url');
        $status = $request->input('status');

        Location::create([
            'name' => $name,
            'address' => $address,
            'map_url' => $map_url,
            'status' => $status,
        ]);

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
        $name = $request->input('name');
        $address = $request->input('address');
        $map_url = $request->input('map_url');
        $status = $request->input('status');

        $location = Location::findOrFail($id);
        $location->update([
            'name' => $name,
            'address' => $address,
            'map_url' => $map_url,
            'status' => $status,
        ]);

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
