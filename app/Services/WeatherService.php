<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHERMAP_API_KEY');
    }

    //This API fetches 40 weather forecasts for a city in a 3-hour interval meaning it will return 5 days worth of weather forecast
    public function getWeather($city)
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/forecast?q=$city&appid={$this->apiKey}");

        return $response->json();
    }
}
