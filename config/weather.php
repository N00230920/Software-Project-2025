<?php

return [
    'api_key' => env('OPENWEATHERMAP_API_KEY'),
    'base_url' => env('OPENWEATHERMAP_BASE_URL', 'https://api.openweathermap.org/data/2.5'),
    
    // You can add more default settings here
    'default_city' => 'Dublin',
    'units' => 'metric', // 'metric' for Celsius, 'imperial' for Fahrenheit
];