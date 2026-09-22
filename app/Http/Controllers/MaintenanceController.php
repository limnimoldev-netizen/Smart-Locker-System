<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        return view('maintenance.index', [
            'maintenances' => Maintenance::latest()->get(),
            'totalRequests' => Maintenance::count(),
            'pendingRequests' => Maintenance::where('status', 'pending')->count(),
            'completedRequests' => Maintenance::where('status', 'completed')->count(),
        ]);
    }

    public function create()
    {
        return view('maintenance.create');
    }

    public function store(Request $request)
    {
        $locker_id = $request->input('locker_id');
        $description = $request->input('description');
        $status = $request->input('status');
        $priority = $request->input('priority');

        Maintenance::create([
            'locker_id' => $locker_id,
            'description' => $description,
            'status' => $status,
            'priority' => $priority,
        ]);

        return redirect()->route('maintenance.index');
    }

    public function show($id)
    {
        $maintenance = Maintenance::findOrFail($id);

        return view('maintenance.show', compact('maintenance'));
    }

    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id);

        return view('maintenance.edit', compact('maintenance'));
    }

    public function update(Request $request, $id)
    {
        $locker_id = $request->input('locker_id');
        $description = $request->input('description');
        $status = $request->input('status');
        $priority = $request->input('priority');

        $maintenance = Maintenance::findOrFail($id);
        $maintenance->update([
            'locker_id' => $locker_id,
            'description' => $description,
            'status' => $status,
            'priority' => $priority,
        ]);

        return redirect()->route('maintenance.show', $maintenance);
    }

    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();

        return redirect()->route('maintenance.index');
    }
}
