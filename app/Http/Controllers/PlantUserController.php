<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plant;

class PlantUserController extends Controller
{
    // Assign a plant to a user
    public function assignPlantToUser(Request $request, $userId, $plantId)
    {
        $user = User::findOrFail($userId);
        $plant = Plant::findOrFail($plantId);

        $user->plants()->attach($plant->id);

        return response()->json(['message' => 'Plant assigned to user successfully']);
    }
}
