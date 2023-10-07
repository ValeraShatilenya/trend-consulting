<?php

namespace App\Filters\QueryFilter\Locations;

use Illuminate\Database\Eloquent\Builder;
use TheJano\LaravelFilterable\Abstracts\QueryFilterAbstract;
use TheJano\LaravelFilterable\Interfaces\QueryFilterInterface;

class LocationsDatetimeQueryFilter extends QueryFilterAbstract implements QueryFilterInterface
{
    /**
     * Can be used to map the values.
     * It can be returned through resolveValue method
     *
     * @var Array
     */
    protected array $mapValues = [];

    /**
     * Handle The Query Filter
     *
     *
     * @param Builder $builder Query Builder
     * @param string $value
     * @return Builder
     **/
    public function handle(Builder $builder, $value): Builder
    {
        $builder->inDate($value);

        return $builder;
    }
}
