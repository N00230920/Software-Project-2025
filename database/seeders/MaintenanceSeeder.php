<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Maintenance;
use Carbon\Carbon;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now();
        Maintenance::insert([
            [
                'frequency' => 'Weekly',
                'description' => 'Watering'
            ],

            [
                'frequency' => 'Daily',
                'description' => 'Light'
            ],

            [
                'frequency' => 'Monthly',
                'description' => 'Fertilise'
            ]

        ]);
    }
}
