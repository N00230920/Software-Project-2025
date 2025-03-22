<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Plant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::all(); // Retrieve all notes
        return view('notes.index', compact('notes')); // Pass notes to the view
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

        /**
 * Store a newly created resource in storage.
 */
public function store(Request $request, Plant $plant)
{
    // ✅ Validate input data
    $request->validate([
        'note' => 'nullable|string|max:1000',
    ]);

    // ✅ Create the note associated with the plant and user
$plant->notes()->create([

        'user_id' => auth()->id(),
        'note' => $request->input('note'),
    ]);

    // ✅ Redirect back with success message
    return redirect()->route('plants.show', $plant)->with('success', 'Note added successfully.');
}

    

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $plant = $note->plant; // Assuming the Note model has a relationship with Plant
        return view('notes.edit', compact('note', 'plant'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $note->update($request->only(['note']));
        return redirect()->route('plants.show',$note->plant_id) ->with('success','Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

       $plant = $note->plant; // Assuming the Note model has a relationship with Plant
       return redirect()->route('plants.show', $plant)->with('success', 'Note deleted successfully!');

    }
}
