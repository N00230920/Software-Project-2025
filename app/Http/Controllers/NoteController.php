<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    $request->validate([
        'note' => 'nullable|string|max:1000',
        'task' => 'nullable|string|max:1000'
    ]);

    // Create the review associated with the book and user
    $book->reviews()->create([
        'user_id' => auth()->id(),
        'note' => $request->input('note'),
        'task' => $request->input('task'),
        'plant_id' => $plant->id
    ]);

    return redirect()->route('plants.show', $book)->with('success', 'Note added successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
