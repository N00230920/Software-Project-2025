<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PlantSeeder::class);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'unique_test_user@example.com', // Updated to a unique email
        ]);

        $users = User::factory(5)->create();
        $plants = Plant::factory(10)->create();

        // Create plant-user relationships with required fields
        $users->each(function ($user) use ($plants) {
            $plants->random(rand(1, 5))->each(function ($plant) use ($user) {
                \App\Models\PlantUser::factory()->create([
                    'user_id' => $user->id,
                    'plant_id' => $plant->id,
                    'name' => $plant->name . ' ' . $user->name,
                    'location' => 'Default Location'
                ]);
            });
        });
    }
}
