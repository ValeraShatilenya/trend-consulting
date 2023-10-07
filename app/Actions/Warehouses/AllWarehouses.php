<?php

namespace App\Actions\Warehouses;

use App\Models\Warehouse;
use App\Http\Resources\WarehouseResource;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AllWarehouses
{
    use AsAction;

    public function handle(): AnonymousResourceCollection
    {
        $warehouses = Warehouse::orderBy('name')->get();
        return WarehouseResource::collection($warehouses);
    }
}
