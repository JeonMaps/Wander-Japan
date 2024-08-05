<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FoursquareService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('FOURSQUARE_API_KEY');
    }

    //Function for searching venues based on the location, category selected, and the limit of results to be passed
    public function searchVenues($near, $categories, $limit)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->apiKey,
        ])->get('https://api.foursquare.com/v3/places/search', [
            'near' => $near,
            'categories' => $categories,
            'limit' => $limit,
        ]);

        return $response->json();
    }

    //Gets the details of the venue based on the venue ID
    public function getVenueDetails($venueId)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->apiKey,
        ])->get("https://api.foursquare.com/v3/places/{$venueId}");

        return $response->json();
    }

    //Gets the photos of the venue based on the venue ID
    public function getVenuePhotos($venueId, $limit = 12)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->apiKey,
        ])->get("https://api.foursquare.com/v3/places/{$venueId}/photos", [
            'limit' => $limit
        ]);

        return $response->json();
    }

    //Gets the tips of the venue based on the venue ID
    public function getVenueTips($venueId)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->apiKey,
        ])->get("https://api.foursquare.com/v3/places/{$venueId}/tips");

        return $response->json();
    }
}
