<?php

namespace Database\Factories;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class PlantFactory extends Factory
{
    protected $model = Plant::class;

    public function definition()
    {
        
        $imageFiles = Storage::files('public/images/plants');

        $imagePath = count ($imageFiles) ? str_replace('public/','',
        $this -> faker ->randomElement($imageFiles))
        : '/default_plant.jpg';

        return [
            'name' => $this->faker->word,
            'species' => $this->faker->word,
            'info' => $this->faker->sentence,
            'location' => $this->faker->word,
            'image' => $this->faker->imageUrl(),
            'date_added' => now(),
        ];
    }
}
