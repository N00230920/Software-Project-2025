<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherApiTest extends TestCase
{
    public function test_fetch_current_weather_successfully()
{
    // Mock the external API
    Http::fake([
        'api.openweathermap.org/data/2.5/weather*' => Http::response([
            'weather' => [['main' => 'Clouds']],
            'main' => ['temp' => 25.5],
            'name' => 'London',
            'cod' => 200
        ], 200)
    ]);

    // Call your endpoint
    $response = $this->getJson('/api/current-weather?city=London');

    // Assert the response
    $response->assertStatus(200)
        ->assertJsonStructure([
            'weather' => [
                ['main']
            ],
            'main' => [
                'temp'
            ],
            'name'
        ])
        ->assertJson([
            'weather' => [['main' => 'Clouds']]
        ])
        ->assertJsonPath('main.temp', fn ($temp) => is_numeric($temp));
}

}