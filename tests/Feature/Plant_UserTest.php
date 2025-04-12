<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class Plant_UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_create_plantuser()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);
        $plant = \App\Models\Plant::factory()->create();

        $this->actingAs($admin);

        $fakeImage = UploadedFile::fake()->create('rest.jpg');
        
        $response = $this->post(route('plantuser.store', ['plant' => $plant->id]), [
            'name' => 'test',
            'location' => 'test Location',
            'image' => $fakeImage,
        ]);

        $this ->assertDatabaseHas('plant_user', ['name' => 'test']);

        $response->assertRedirect(route('plantuser.index'));
    }

    public function test_cannot_create_plantuser()
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user);

        $fakeImage = UploadedFile::fake()->create('rest.jpg');
        
        $plant = \App\Models\Plant::factory()->create();
        $response = $this->post(route('plantuser.store', ['plant' => $plant->id]), [
            'name' => 'Failed test',
            'location' => 'Failed test Location',
            'image' => $fakeImage,
        ]);

        $this->assertDatabaseMissing('plant_user',['name'=>'Failed Test']);

        $response->assertRedirect(route('plantuser.index'));

        $response->assertSessionHas('error','Access denied');
    }


}
