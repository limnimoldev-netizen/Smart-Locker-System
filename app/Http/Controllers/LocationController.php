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
        return view('user.locations.index');
    }

}
