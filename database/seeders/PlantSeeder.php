<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plant;
use Carbon\Carbon;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now();
        Plant::insert([
            [
                'name' => 'Aloe Vera',
                'species' => 'Aloe barbadensis miller',
                'info' => 'Great for skin care, soothing burns, cuts, and irritations with its anti-inflammatory properties. It also purifies indoor air by removing toxins like formaldehyde and benzene. Additionally, it’s a low-maintenance plant, perfect for beginners.',
                'location' => 'Bathroom',
                'image' => 'aloe.jpg',
                'date_added' => $currentTimestamp->format('Y-m-d')
            ],

            [
                'name' => ' Lavender',
                'species' => 'Lavandula angustifolia',
                'info' => 'Ideal for aromatherapy, as its calming scent reduces stress and improves sleep. It’s also used in cooking to flavor dishes, teas, and desserts. Additionally, it acts as a natural insect repellent, deterring mosquitoes and moths.',
                'location' => 'Bedroom',
                'image' => 'lavender.jpg',
                'date_added' => $currentTimestamp->format('Y-m-d')
            ],

            [
                'name' => 'Snake Plant',
                'species' => 'Dracaena trifasciata',
                'info' => 'Excellent for air purification, converting CO2 into oxygen at night, making it perfect for bedrooms. It thrives in low-light conditions and requires minimal watering, making it a hardy indoor plant. Its drought resistance also makes it easy to care for.',
                'location' => 'Bedroom',
                'image' => 'snake_plant.jpg',
                'date_added' => $currentTimestamp->format('Y-m-d')
            ],

            [
                'name' => 'Basil',
                'species' => 'Ocimum basilicum',
                'info' => 'A culinary favorite, used in pesto, salads, and Italian dishes for its fresh flavor. It also has medicinal properties, containing antioxidants and anti-inflammatory compounds. Additionally, it repels pests like mosquitoes and aphids when grown near other plants.',
                'location' => 'Kitchen',
                'image' => 'basil.jpg',
                'date_added' => $currentTimestamp->format('Y-m-d')
            ],

            [
                'name' => 'Sunflower',
                'species' => ' Helianthus annuus',
                'info' => 'A vibrant ornamental plant that adds color to gardens and landscapes. It attracts pollinators like bees and birds, supporting local ecosystems. Its seeds are edible, rich in healthy fats, protein, and vitamins.',
                'location' => 'Balcony',
                'image' => 'sunflower.jpg',
                'date_added' => $currentTimestamp->format('Y-m-d')
            ]

        ]);
    }
}
