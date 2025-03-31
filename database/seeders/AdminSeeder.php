<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Auth\Events\Registered; // Add this line
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate([ // Check if the user already exists
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);


        event(new Registered($user)); // Use the created user for the event
        Auth::login($user);
    }
}
