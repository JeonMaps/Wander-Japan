<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\FoursquareController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('api/weather/{city}', [WeatherController::class, 'getWeather']);

Route::get('api/places/search', [FoursquareController::class, 'search']);
Route::get('api/places/{venueId}', [FoursquareController::class, 'details']);
Route::get('api/places/{venueId}/photos', [FoursquareController::class, 'photos']);
Route::get('api/places/{venueId}/tips', [FoursquareController::class, 'tips']);



