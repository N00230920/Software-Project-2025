<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('weather.api_key');
        $this->baseUrl = config('weather.base_url');
    }

    public function getCurrentWeather($city)
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/weather", [
                'query' => [
                    'q' => $city,
                    'appid' => $this->apiKey,
                    'units' => 'metric', // or 'imperial'
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("Weather API error: " . $e->getMessage());
            return null;
        }
    }

    // Add more methods for forecasts, etc. as needed
}