<?php

namespace App\Filters\Filterable;

use TheJano\LaravelFilterable\Abstracts\FilterableAbstract;
use TheJano\LaravelFilterable\Interfaces\FilterableInterface;
use App\Filters\QueryFilter\Locations\LocationsSearchQueryFilter;
use App\Filters\QueryFilter\Locations\LocationsDatetimeQueryFilter;
use App\Filters\QueryFilter\Locations\LocationsWarehousesQueryFilter;

class LocationsFilterable extends FilterableAbstract implements FilterableInterface
{
    /**
     * It contains list of Query Filters
     *
     * @var Array
     */
    protected array $filters = [
        'search' => LocationsSearchQueryFilter::class,
        'datetime' => LocationsDatetimeQueryFilter::class,
        'warehouses' => LocationsWarehousesQueryFilter::class
    ];
}
