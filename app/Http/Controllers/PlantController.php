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
                'info' => 'required|max:500',
                'location' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        
            // Check if the image is uploaded and handle it
            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/books'), $imageName);
            }
        
            // Create a book record in the database
            Book::create([
                'name' => $request->name,
                'info' => $request->info, 
                'species' => $request->species,
                'location' => $request->location,
                'image' => $imageName, // Store the image filename in the DB
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        
            // Redirect to the index page with a success message
            return to_route('plants.index')->with('success', 'Plant created successfully!');
        }
        

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant)
    {
        return view('plants.show')->with('plant',$plant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plant $plant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plant $plant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
        //
    }
}
