<?php

namespace Database\Factories;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlantFactory extends Factory
{
    protected $model = Plant::class;

    public function definition()
    {
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
