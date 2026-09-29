<?php

namespace App\Http\Controllers;

use App\Models\LockerUsage;
use App\Models\Locker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LockerUsageController extends Controller
{
    public function index()
    {
        $usages = LockerUsage::with('locker.location')
            ->where('user_id', Auth::id())
            ->latest('started_at')
            ->get();

        return view('user.usage.index', compact('usages'));
    }

    public function show(LockerUsage $lockerUsage)
    {
        abort_unless((int) $lockerUsage->user_id === (int) Auth::id(), 404);

        $locker = $lockerUsage->locker;
        $location = $locker->location;

        return view('locker-usages.show', compact('lockerUsage', 'locker', 'location'));
    }

    public function release(LockerUsage $lockerUsage)
    {
        abort_unless((int) $lockerUsage->user_id === (int) Auth::id(), 404);

        DB::transaction(function () use ($lockerUsage) {
            $usage = LockerUsage::query()->lockForUpdate()->findOrFail($lockerUsage->getKey());

            if ($usage->status !== 'active') {
                return;
            }

            $locker = Locker::query()->lockForUpdate()->findOrFail($usage->locker_id);
            $usage->update([
                'status' => 'released',
                'ended_at' => now(),
            ]);
            $locker->update(['status' => 'available']);
        });

        return redirect()->route('user.lockers.index');
    }
}
