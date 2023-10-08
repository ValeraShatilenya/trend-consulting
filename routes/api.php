<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LocationsController;
use App\Http\Controllers\Api\WarehousesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/locations', [LocationsController::class, 'index'])->name('locations.index');

Route::get('/warehouses/all', [WarehousesController::class, 'all'])->name('warehouses.all');
