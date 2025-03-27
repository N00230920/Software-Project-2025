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
            'email' => 'tes@example.com',
        ]);

        $users = User::factory(5)->create();
        $plants = Plant::factory(10)->create();

        // Attach random plants to users
        $users->each(function ($user) use ($plants) {
            $user->plants()->attach($plants->random(rand(1, 5))->pluck('id'));
        });
    }
}
