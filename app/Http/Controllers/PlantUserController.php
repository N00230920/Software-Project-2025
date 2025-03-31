<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Plant;
use App\Models\PlantUser; // Import the PlantUser model


class PlantUserController extends Controller
{

    public function index()
    {
        $plants = PlantUser::all(); // Fetch all records from the plant_user table
        return view('plantuser.index', compact('plants'));
    }
    
    public function create(Plant $plant)
    {
        return view('plantuser.add', compact('plant'));
    }

    public function show($id)
{
    $plantUser = PlantUser::findOrFail($id);
    return view('plantuser.show', compact('plantUser'));
}


    public function store(Request $request, $plant)
    {
        // Validation with custom messages
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ], [
            'name.required' => 'The plant name is required.',
            'location.required' => 'Please select a location for the plant.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 5MB.',
        ]);

        
    
        // Handle the image upload if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('plants/', 'public');
        }

    
        // Prepare the plant user data
        $plantUserData = [
            'name' => $request->name,
            'location' => $request->location,
            'image' => $imagePath, // Store the image filename in the DB if uploaded

        ];
    
        // Find the plant by its ID
        $plant = Plant::findOrFail($plant);

    
        // Prepare the plant user data
        $plantUserData = [
            'name' => $request->name,
            'location' => $request->location,
            'image' => $imagePath, // Store the image filename in the DB if uploaded
            'plant_id' => $plant->id, // Add the plant ID
            'user_id' => Auth::id(), // Add the authenticated user ID
        ];

        // Create a new record in the plant_user table
        PlantUser::create($plantUserData);


    
        // Redirect with success message
        return redirect()->route('plantuser.index')->with('success', 'Plant added successfully!');
    }
    

    public function edit($id)
{
    $plantUser = PlantUser::findOrFail($id);
    return view('plantuser.edit', compact('plantUser'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
    ]);

    $plantUser = PlantUser::findOrFail($id);
    $plantUser->update([
        'name' => $request->name,
        'location' => $request->name,
        'image' => $request->image ? $this->uploadImage($request->image) : $plantUser-> image,
    ]);

    return redirect()->route('plantuser.index')->with('success', 'Plant updated successfully!');
}

public function destroy($id)
{
    $plantUser = PlantUser::findOrFail($id);
    $plantUser->delete();

    return redirect()->route('plantuser.index')->with('success', 'Plant deleted successfully!');
}

}
