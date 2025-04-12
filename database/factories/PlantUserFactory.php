<?php

namespace Database\Factories;
use App\Models\Plant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlantUserFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'plant_id' => Plant::factory(),
            'name' => $this->faker->word,
            'location' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function withUserAndPlant($userId, $plantId)
    {
        return $this->state([
            'user_id' => $userId,
            'plant_id' => $plantId,
            'name' => $this->faker->word,
            'location' => $this->faker->word,
        ]);
    }
}
