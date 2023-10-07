<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Location;
use App\Models\Warehouse;
use App\Models\ProductType;
use App\Models\ProductColor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;

class DatabaseSeeder extends Seeder
{
    const COUNT_PRODUCTS = 100;

    /**
     * Seed the application's database.
     * 
     * @return void
     */
    public function run(): void
    {
        Location::truncate();
        Product::truncate();
        ProductType::truncate();
        ProductColor::truncate();
        Warehouse::truncate();

        foreach (['Стол', 'Стул', 'Кресло'] as $name) {
            ProductType::create(compact('name'));
        }

        foreach ([['Чёрный', '#000000'], ['Белый', '#ffffff']] as list($name, $hex)) {
            ProductColor::create(compact('name', 'hex'));
        }

        foreach (['Склад 1', 'Склад 2'] as $name) {
            Warehouse::create(compact('name'));
        }

        /** @var Collection<Warehouse> */
        $warehouses = Warehouse::all();


        Product::factory(self::COUNT_PRODUCTS)
            ->create()
            ->each(function (Product $product) use ($warehouses) {
                $this->fillProductLocations($product, $warehouses);
            });
    }

    /**
     * Fill locations for specific product. 
     * 
     * @param Product $product
     * @param Collection<Warehouse> $warehouses
     * 
     * @return void
     */
    private function fillProductLocations(Product $product, Collection $warehouses): void
    {
        $secondsInDay = 60 * 60 * 24;
        $secondsIn7Day = $secondsInDay * 7;

        $countWarehouses = $warehouses->count();

        $locations = [];
        $date = $this->randomDate();
        $count = rand(3, 7);
        for ($i = 0; $i < $count; $i++) {
            $locations[] = [
                'warehouse_id' => $warehouses[$i % $countWarehouses]->id,
                'period_start' => $date->addSecond()->toDateTimeString(),
                'period_end' => $count - 1 === $i ? null : $date->addSeconds(rand($secondsInDay, $secondsIn7Day))->toDateTimeString(),
            ];
        }
        $product->locations()->createMany($locations);
    }

    /**
     * Get random date.
     * 
     * @return Carbon
     */
    private function randomDate(): Carbon
    {
        $date = Carbon::now()->subMonths(3);
        $min = $date->timestamp;
        $max = $date->addMonth()->timestamp;

        return Carbon::createFromTimestamp(rand($min, $max));
    }
}
