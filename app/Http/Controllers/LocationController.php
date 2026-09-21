<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return view('locations.index');
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $address = $request->input('address');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $mapUrl = "https://www.google.com/maps?q={$latitude},{$longitude}";
        $status = $request->input('status');

        Location::create([
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'map_url' => $mapUrl,
            'status' => $status,
        ]);
        
        return redirect()->route('locations.index');
    }

    public function edit()
    {
        return view('locations.edite');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('locations.index');
    }

    public function userIndex()
    {
        return view('user.locations.index');
    }
}
