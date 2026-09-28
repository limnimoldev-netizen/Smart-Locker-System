<?php

namespace App\Http\Controllers;

use App\Models\LockerUsage;
use Illuminate\Http\Request;

class UsageHistoryController extends Controller
{
    public function index(Request $request)
    {
        $usages = LockerUsage::with('locker.location')
            ->where('user_id', auth()->id())
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->latest('started_at')
            ->paginate(10)
            ->withQueryString();

        return view('user.usage.index', compact('usages'));
    }
}
