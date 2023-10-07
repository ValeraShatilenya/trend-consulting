<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $lastLocaion = $product->lastLocation;
        $warehouse = Warehouse::when(
            $lastLocaion,
            fn (Builder $builder) =>
            $builder->where('id', '!=', $lastLocaion->warehouse->id)
        )->inRandomOrder()->first();
        $periodStart = $lastLocaion?->period_end ?? fake()->dateTimeBetween('-1 year', '-1 month');
        $periodEnd = Carbon::createFromDate($periodStart)->addDays(rand(3, 7));
        return [
            'product_id' => $product,
            'warehouse_id' => $warehouse,
            'period_start' => $periodStart,
            'period_end' => $periodEnd,
        ];
    }
}
