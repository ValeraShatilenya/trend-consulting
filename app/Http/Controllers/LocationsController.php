<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Actions\Locations\IndexLocations;
use App\Actions\Warehouses\AllWarehouses;
use App\Http\Requests\Locations\IndexLocationsRequest;

class LocationsController extends Controller
{
    public function index(IndexLocationsRequest $request)
    {
        return Inertia::render('Locations/Index', [
            'locations' => fn () => IndexLocations::run($request),
            'warehouses' => fn () => AllWarehouses::run(),
            'now' => fn () => Carbon::now()->toDateTimeString()
        ]);
    }
}
