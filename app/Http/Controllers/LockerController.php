<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\Location;
use Illuminate\Http\Request;

class LockerController extends Controller
{
    public function index()
    {
        return view('lockers.index', [
            'lockers' => Locker::latest()->get(),
            'totalLockers' => Locker::count(),
            'availableLockers' => Locker::where('status', 'available')->count(),
            'maintenanceLockers' => Locker::where('status', 'maintenance')->count(),
        ]);
    }

    public function create()
    {
        return view('lockers.create', [
            'locations' => Location::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $location_id = $request->input('location_id');
        $type = $request->input('type');
        $status = $request->input('status');

        Locker::create([
            'location_id' => $location_id,
            'type' => $type,
            'status' => $status,
            'locker_number' => $request->input('locker_number'),

        ]);

        return redirect()->route('lockers.index');
    }

    public function show($id)
    {
        $locker = Locker::findOrFail($id);

        return view('lockers.show', compact('locker'));
    }

    public function edit($id)
    {
        $locker = Locker::findOrFail($id);

        return view('lockers.edit', compact('locker'));
    }

    public function update(Request $request, $id)
    {
        $location_id = $request->input('location_id');
        $type = $request->input('type');
        $status = $request->input('status');

        $locker = Locker::findOrFail($id);
        $locker->update([
            'location_id' => $location_id,
            'type' => $type,
            'status' => $status,
        ]);

        return redirect()->route('lockers.show', $locker);
    }

    public function destroy($id)
    {
        $locker = Locker::findOrFail($id);
        $locker->delete();

        return redirect()->route('lockers.index');
    }

    public function userIndex()
    {
        return view('user.lockers.index');
    }
}
