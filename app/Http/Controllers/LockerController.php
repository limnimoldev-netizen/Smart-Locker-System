<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Locker;
use Illuminate\Http\Request;


class LockerController extends Controller
{
    public function index()
    {
        return view('lockers.index');
    }

    public function edit(Locker $locker)
    {
        return view('lockers.edit', compact('locker'));
    }

    public function update(Request $request, Locker $locker)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'status' => 'required', 
        ]);

        $locker->update($validated);

        return redirect()->route('dashboard.index')
                         ->with('success', 'Locker updated successfully!');
    }

    public function destroy(Locker $locker)
    {
        $locker->delete();

        return redirect()->route('dashboard')
                         ->with('success', 'Locker deleted successfully!');
    }
}
