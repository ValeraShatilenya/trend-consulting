<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Actions\Warehouses\AllWarehouses;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WarehousesController extends Controller
{
    public function all(): AnonymousResourceCollection
    {
        return AllWarehouses::run();
    }
}
