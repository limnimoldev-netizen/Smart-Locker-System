<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\LockerUsage;
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
        $lockers = Locker::with('location')->get();

        return view('lockers.index', compact('lockers'));
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