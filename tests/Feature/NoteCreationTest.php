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

    /** @test */
    public function a_user_can_create_a_note_for_a_plant()
    {
        // Create a user and a plant
        $user = User::factory()->create();
        $plant = Plant::factory()->create();

        $this->actingAs($user)
            ->post(route('notes.store', $plant), [
                'note' => 'This is a test note.',
            ]);

        // Check that the note was created in the database
        $this->assertDatabaseHas('notes', [
            'note' => 'This is a test note.',
            'user_id' => $user->id,
            'plant_id' => $plant->id,
        ]);
    }

}
