<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\FoursquareService;

class FoursquareController extends Controller
{
    protected $foursquareService;

    public function __construct(FoursquareService $foursquareService)
    {
        $this->foursquareService = $foursquareService;
    }

    public function search(Request $request)
    {
        $categories = $request->input('categories');
        $near = $request->input('near');
        $limit = $request->input('limit');
        $venues = $this->foursquareService->searchVenues($near, $categories, $limit);

        return response()->json($venues);
    }

    public function details($venueId)
    {
        $details = $this->foursquareService->getVenueDetails($venueId);

        return response()->json($details);
    }

    public function photos($venueId)
    {
        $photos = $this->foursquareService->getVenuePhotos($venueId);

        return response()->json($photos);
    }

    public function tips($venueId)
    {
        $tips = $this->foursquareService->getVenueTips($venueId);

        return response()->json($tips);
    }
}
