<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Plant;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class NoteCreationTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\test]

    public function a_user_can_create_a_note_for_a_plant()
    {
        // Arrange: Create a user and a plant
        $user = User::factory()->create();
        $plant = Plant::factory()->create();

        // Log user and plant details
        \Log::info('User created:', ['user_id' => $user->id]);
        \Log::info('Plant created:', ['plant_id' => $plant->id]);

        // Act: Authenticate the user and create a note
        \Log::info('User authenticated:', ['authenticated' => Auth::check()]);

        $this->actingAs($user)
            ->post(route('notes.store', $plant), [
                'note' => 'This is a test note.',
            ]);

        // Assert: Check that the note was created in the database
        $this->assertDatabaseHas('notes', [
            'note' => 'This is a test note.',
            'user_id' => $user->id,
            'plant_id' => $plant->id,
        ]);
    }
}
