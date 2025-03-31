<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plants = Plant::all();
        return view('plants.index', compact('plants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect()->route('plants.index')->with('error', 'Access Denied.');
        }
        return view('plants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required',
            'info' => 'nullable|max:500',
            'species' => 'nullable',
            'location' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10240', // Updated max size
        ]);

        // Check if the image is uploaded and handle it
        $imageName = null; // Initialize imageName
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            if (!$request->image->move(public_path('images/plants'), $imageName)) {
                return redirect()->back()->withErrors(['image' => 'Image upload failed. Please try again.']);
            }
        }

        // Create a plant record in the database
        $plantData = [
            'name' => $request->name,
            'info' => $request->info,
            'species' => $request->species,
            'location' => $request->location,
            'image' => $imageName, // Store the image filename in the DB if uploaded
            'date_added' => now(), // Ensure date_added is set
        ];

        Plant::create($plantData);

        // Redirect to the index page with a success message
        return to_route('plants.index')->with('success', 'Plant created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant)
    {
        $plant->load('notes.user');
        $plant->load('maintenances.plant');

        return view('plants.show', compact('plant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plant $plant)
    {
        return view('plants.edit', compact('plant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plant $plant)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10240', // Updated max size
        ]);

        // Check if the image is uploaded and handle it
        $imageName = null; // Initialize imageName
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            if (!$request->image->move(public_path('images/plants'), $imageName)) {
                return redirect()->back()->withErrors(['image' => 'Image upload failed. Please try again.']);
            }
        }

        $plant->update(array_merge($validatedData, ['image' => $imageName]));

        return redirect()->route('plants.index')->with('success', 'Plant updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
        $plant->delete();

        return redirect()->route('plants.index')->with('success', 'Plant deleted successfully!');
    }
}
