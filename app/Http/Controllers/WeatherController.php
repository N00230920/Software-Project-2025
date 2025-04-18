<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function show(Request $request)
    {
        $city = $request->input('city', 'London');
        $weather = $this->weatherService->getCurrentWeather($city);

        if (!$weather) {
            return back()->with('error', 'Failed to fetch weather data.');
        }

        return view('weather.show', [
            'weather' => $weather,
            'city' => $city
        ]);
    }

    public function apiCurrentWeather(Request $request)
    {
        $city = $request->input('city', 'London');
        $weather = $this->weatherService->getCurrentWeather($city);

        if (!$weather) {
            return response()->json(['error' => 'Failed to fetch weather data'], 404);
        }

        return response()->json($weather);
    }
}
