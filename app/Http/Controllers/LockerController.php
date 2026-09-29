<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Locker;
use Illuminate\Http\Request;


class LockerController extends Controller
{
    public function confirm(Locker $locker)
    {
        $location = $locker->location;

        return view('user.lockers.confirm', compact('locker', 'location'));
    }

    public function store(Locker $locker)
    {
        $usage = LockerUsage::create([
            'locker_id' => $locker->id,
            'user_id' => auth()->id() ?? 1,
            'access_code' => strtoupper(substr(md5(uniqid()), 0, 6)),
            'status' => 'active',
            'started_at' => now(),
        ]);

        $locker->update(['status' => 'in_use']);

        return redirect('/user/lockers');
    }

    // Admin list: /lockers
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

    // User "My Locker" page: /user/lockers
    public function userIndex()
    {
        $usages = LockerUsage::with('locker.location')
            ->where('user_id', auth()->id() ?? 1)
            ->where('status', 'active')
            ->latest('started_at')
            ->get();

        return view('user.lockers.mine', compact('usages'));
    }
}