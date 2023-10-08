<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WarehouseTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_get_warehouses_all(): void
    {
        $this->get(route('api.warehouses.all'))
            ->assertOk()
            ->assertSessionDoesntHaveErrors()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                ]
            ]);
    }
}
