<?php

namespace App\Actions\Locations;

use Carbon\Carbon;
use App\Models\Location;
use App\Http\Resources\LocationResource;
use Illuminate\Database\Eloquent\Builder;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Filters\Filterable\LocationsFilterable;
use App\Http\Requests\Locations\IndexLocationsRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexLocations
{
    use AsAction;

    public function handle(IndexLocationsRequest $request): AnonymousResourceCollection
    {
        $locations = Location::with('product.color', 'product.type', 'warehouse')
            ->filterable(LocationsFilterable::class)
            ->when(!$request->datetime, fn (Builder $query) => $query->inDate(Carbon::now()->toDateTimeString()))
            ->orderBy('period_start')
            ->paginate(10)
            ->onEachSide(1)
            ->withQueryString();
        return LocationResource::collection($locations);
    }
}
