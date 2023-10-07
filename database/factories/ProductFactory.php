<?php

namespace Database\Factories;

use App\Models\ProductType;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'product_type_id' => ProductType::inRandomOrder()->first(),
            'product_color_id' => ProductColor::inRandomOrder()->first(),
        ];
    }
}
