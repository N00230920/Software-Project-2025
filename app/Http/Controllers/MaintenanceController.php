<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::all();
        return view('maintenances.index', compact('maintenances'));
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
        return redirect()->route('maintenances.index')->with('success', 'Maintenance task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenances.index')->with('success', 'Maintenance task deleted successfully.');
    }
}
