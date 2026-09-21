<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Locker;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return view('locations.index', [
            'locations' => Location::latest()->get(),
            'totalLocations' => Location::count(),
            'activeLocations' => Location::where('status', 'active')->count(),
            'totalLockers' => Locker::count(),
        ]);
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $address = $request->input('address');
        $status = $request->input('status');

        Location::create([
            'name' => $name,
            'address' => $address,
            'latitude' => '0',
            'longitude' => '0',
            'map_url' => 'https://www.google.com/maps',
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
        $status = $request->input('status');

        $location = Location::findOrFail($id);
        $location->update([
            'name' => $name,
            'address' => $address,
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
        return view('user.locations.index');
    }

}
