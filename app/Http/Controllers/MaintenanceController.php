<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlantUser;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Maintenance::where('plant_user_id', auth()->id())->get();
        return view('maintenance.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('maintenances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required',
            'frequency' => 'required',
            'care_level' => 'required',
        ]);

        $maintenance = Maintenance::create($request->validated());
        return redirect()->route('maintenances.index')->with('success', 'Maintenance task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        return view('maintenances.show', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        return view('maintenances.edit', compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $maintenance->update($request->validated());
        return back()->with('success', 'Task updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenances.index')->with('success', 'Maintenance task deleted successfully.');
    }

    public function complete(Request $request, Maintenance $maintenance)
    {
        
        if (!$maintenance) {
            return back()->with('error', 'Maintenance task not found.');
        }

        $request->validate([
            'notes' => 'nullable|string',
        ]);

        $maintenance->logs()->create([
            'plant_user_id' => auth()->id(),
            'completed_at' => now(),
        ]);

        $maintenance->update([
            'last_maintenance_date' => now(),
        ]);

        return redirect()->route('plantuser.show', ['id' => $maintenance->plant_user_id])
->with('success', 'Maintenance task complete.');
    }

}
