<?php

namespace App\Http\Controllers;

use App\Models\LockerUsage;

class LockerUsageController extends Controller
{
    public function show(LockerUsage $lockerUsage)
    {
        $locker = $lockerUsage->locker;
        $location = $locker->location;

        return view('locker-usages.show', compact('lockerUsage', 'locker', 'location'));
    }

    public function release(LockerUsage $lockerUsage)
    {
        $lockerUsage->update([
            'status' => 'released',
            'ended_at' => now(),
        ]);

        $lockerUsage->locker->update(['status' => 'available']);

        return redirect('/locations/search');
    }
}
