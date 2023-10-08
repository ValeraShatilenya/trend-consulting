<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Actions\Locations\IndexLocations;
use App\Http\Requests\Locations\IndexLocationsRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LocationsController extends Controller
{
    public function index(IndexLocationsRequest $request): AnonymousResourceCollection
    {
        return IndexLocations::run($request);
    }
}
