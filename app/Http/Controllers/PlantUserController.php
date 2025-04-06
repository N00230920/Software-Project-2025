<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Plant; 
use Illuminate\Support\Facades\Storage; // Import Storage facade
use App\Models\PlantUser; // Import the PlantUser model

class PlantUserController extends Controller
{

    public function index()
    {
        $plantUsers = PlantUser::where('user_id', Auth::id())->get(); // Fetch all records from the plant_user table
        return view('plantuser.index', compact('plantUsers'));
    }
    
    public function create(Plant $plant)
    {
        return view('plantuser.add', compact('plant'));
    }

    public function show($id)
    {
        $plantUser = PlantUser::with('maintenances')->findOrFail($id);
        if (!$plantUser) {
            return redirect()->route('plantuser.index')->withErrors(['error' => 'Plant user not found.']);
        }
        $plant = Plant::findOrFail($plantUser->plant_id); // Retrieve the associated Plant
        $maintenance = $plantUser->maintenances->first(); // Get the first maintenance record
        $maintenancelogs = $plantUser->logs()->latest()->take(5)->get(); // Get recent maintenance logs
        return view('plantuser.show', compact('plantUser', 'plant', 'maintenance', 'maintenancelogs')); // Pass all variables to the view
    }

    public function store(Request $request, Plant $plant)
    {
$request->validate([
    'name' => 'required|string|max:255',
    'location' => 'required|string|max:255',
    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
    // Add any new validation rules here
        ]);
    
        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->file('image')->move(public_path('images/plants'), $imageName);
        }
    
        // Prepare the plant user data
        $plantUserData = [
            'name' => $request->name,
            'location' => $request->location,
            'image' => $imageName ?? null,
            'plant_id' => $plant->id,  // Ensure $plant is an object and get its ID
            'user_id' => Auth::id(),
        ];
    
        // Create a new record in the plant_user table
        PlantUser::create($plantUserData);
    
        return redirect()->route('plantuser.index')->with('success', 'Plant added successfully!');
    }

    public function edit($id)
    {
        $plantUser = PlantUser::findOrFail($id);
        $plant = Plant::findOrFail($plantUser->plant_id); // Fetch the related plant
        return view('plantuser.edit', compact('plantUser', 'plant'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $plantUser = PlantUser::findOrFail($id);

        // Preserve the existing image if no new image is uploaded
        $imageName = $plantUser->image;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($plantUser->image) {
                Storage::delete('public/' . $plantUser->image);
            }

            // Get the original filename chosen by the user
            $originalName = $request->file('image')->getClientOriginalName();
            $safeName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();

            // Sanitize filename
            $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', strtolower($safeName));
            $imageName = $safeName . '.' . $extension;

            // Ensure uniqueness
            $storagePath = 'plant_images/' . $imageName;
            if (Storage::disk('public')->exists($storagePath)) {
                $imageName = $safeName . '_' . time() . '.' . $extension;
            }

            // Store the new image in 'storage/app/public/plant_images'
            $request->file('image')->storeAs('plant_images', $imageName, 'public');
        }

        $plantUser->update([
            'name' => $request->name,
            'location' => $request->location,
            'image' => $imageName ?? null, // Update the image if it was uploaded
        ]);

        return redirect()->route('plantuser.index')->with('success', 'Plant updated successfully!');
    }

    public function destroy($id)
    {
        $plantUser = PlantUser::findOrFail($id);

        if ($plantUser->image) {
            Storage::delete('public/' . $plantUser->image);
        }

        $plantUser->delete();

        return redirect()->route('plantuser.index')->with('success', 'Plant deleted successfully!');
    }

    public function searchPlantUser(Request $request)
    {
        $query = $request->query('query'); // Search input (plant name)
        $location = $request->query('location'); // Selected location
        $userId = Auth::id(); // Get logged-in user ID
    
        // Start with all plant users of the logged-in user
        $plantUsers = PlantUser::where('user_id', $userId);
    
        // Filter by plant name if search query is provided
        if (!empty($query)) {
            $plantUsers->whereHas('plant', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            });
        }
    
        // Filter by location if it's selected
        if (!empty($location)) {
            $plantUsers->where('location', $location);
        }
    
        // Retrieve filtered or unfiltered results with the related plant data
        $plantUsers = $plantUsers->with('plant')->get();
    
        return view('plantuser.index', compact('plantUsers'));
    }
    
        
}
