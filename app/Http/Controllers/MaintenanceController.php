<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlantUser;
use App\Models\MaintenanceLog;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Maintenance::whereHas('plantUsers', function($query) {
            $query->where('user_id', auth()->id());
        })->get();
        return view('plantuser.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plants = PlantUser::where('user_id', auth()->id())->get();
        return view('maintenance.create', compact('plants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required',
            'frequency' => 'required',
            'plant_user_id' => 'required|exists:plant_user,id'
        ]);

        $maintenance = Maintenance::create($request->all());
        $maintenance->plantUsers()->attach($request->input('plant_user_id'));
        return redirect()->route('plantuser.show', $maintenance)->with('success', 'Maintenance task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        return view('plantuser.show', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        return view('maintenance.edit', compact('maintenance'));
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
        return redirect()->route('plantuser.index')->with('success', 'Maintenance task deleted successfully.');
    }

    public function completeTask($maintenanceId)
    {
        try {
            // Find the maintenance task
            $maintenance = Maintenance::findOrFail($maintenanceId);
        
            // Check if the task is already completed by this user
            $existingLog = $maintenance->logs()
                ->where('plant_user_id', auth()->id())
                ->first();
        
            if ($existingLog) {
                return back()->with('error', 'This task has already been completed.');
            }
        
            // Create a new log entry through the pivot relationship
            $maintenance->plantUsers()->attach(auth()->id(), [
                'completed_at' => now()
            ]);
        
            // Update the maintenance's last maintenance date
            $maintenance->update([
                'completed_at' => now(),
            ]);

            // Redirect to the plant user's show page
            $plantUser = PlantUser::where('user_id', auth()->id())
                ->whereHas('maintenances', fn($q) => $q->where('maintenance_id', $maintenanceId))
                ->firstOrFail();
        
            return redirect()->route('plantuser.show', $plantUser->id)
                             ->with('success', 'Maintenance task complete!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error completing task: ' . $e->getMessage());
        }
    }

}
