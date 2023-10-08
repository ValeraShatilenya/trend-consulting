<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Location;
use App\Models\Warehouse;
use Illuminate\Testing\Fluent\AssertableJson;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic example.
     */
    public function test_the_application_returns_a_redirect_response(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('locations.index'));

        $response = $this->get('/test');

        $response->assertRedirect(route('locations.index'));
    }

    public function test_open_locations_index_page(): void
    {
        $this->get(route('locations.index'))
            ->assertOk()
            ->assertSessionDoesntHaveErrors()
            ->assertInertia(
                fn ($assert) => $assert
                    ->component('Locations/Index')
                    ->has('locations.data', 10)
                    ->has(
                        'locations.data.0',
                        fn (Assert $assert) => $assert
                            ->has('period_start_iso')
                            ->has('period_end_iso')
                            ->has('product.name')
                            ->has('product.type.name')
                            ->has('product.color.name')
                            ->has('product.color.hex')
                            ->has('warehouse.name')
                            ->etc()
                    )
                    ->has('locations.meta')
                    ->has('warehouses', Warehouse::count())
                    ->has(
                        'warehouses.0',
                        fn (Assert $assert) => $assert
                            ->has('id')
                            ->has('name')
                    )
                    ->has('now')
            );
    }

    public function test_api_get_locations(): void
    {
        $this->get(route('api.locations.index'))
            ->assertOk()
            ->assertSessionDoesntHaveErrors()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'period_start_iso',
                        'period_end_iso',
                        'product' => [
                            'name',
                            'color' => [
                                'name',
                                'hex',
                            ],
                            'type' => [
                                'name'
                            ]
                        ],
                        'warehouse' => [
                            'name'
                        ]
                    ]
                ],
                'meta' => [
                    'current_page',
                    'total',
                    'links' => [
                        '*' => [
                            'url',
                            'label',
                            'active'
                        ]
                    ]
                ]
            ]);
    }

    public function test_open_locations_index_page_with_parameters(): void
    {
        $location = Location::first();
        $productName = $location->product->name;
        $warehouseId = $location->warehouse->id;

        $this->get(
            route('locations.index'),
            [
                'page' => 1,
                'search' => $productName,
                'datetime' => Carbon::now()->format('Y-m-d H:i:s'),
                'warehouses' => [$warehouseId]
            ]
        )
            ->assertOk()
            ->assertSessionDoesntHaveErrors()
            ->assertInertia(
                fn (Assert $assert) => $assert
                    ->component('Locations/Index')
                    ->has('locations.data.0')
                    ->has('warehouses')
                    ->has('now')
            );
    }

    public function test_api_get_locations_with_parameters(): void
    {
        $location = Location::first();
        $productName = $location->product->name;
        $warehouseId = $location->warehouse->id;

        $this->get(route(
            'api.locations.index',
            [
                'page' => 1,
                'search' => $productName,
                'datetime' => Carbon::now()->format('Y-m-d H:i:s'),
                'warehouses' => [$warehouseId]
            ]
        ))
            ->assertOk()
            ->assertSessionDoesntHaveErrors()
            ->assertJson(
                fn (AssertableJson $json) =>
                $json
                    ->has('data.0.period_start_iso')
                    ->has('data.0.period_start_iso')
                    ->has('data.0.period_end_iso')
                    ->has('data.0.product')
                    ->has('data.0.product.name')
                    ->has('data.0.product.color.name')
                    ->has('data.0.product.color.hex')
                    ->has('data.0.product.type.name')
                    ->has('data.0.warehouse.name')
                    ->has('meta')
                    ->etc()
            );
    }
}
