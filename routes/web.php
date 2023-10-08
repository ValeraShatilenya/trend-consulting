<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/locations', [LocationsController::class, 'index'])->name('locations.index');

// Change Lang
Route::get('language/{language}', function ($language) {
    session()->put('locale', $language);
    return redirect()->back();
})->name('language');

Route::fallback(fn () => redirect()->route('locations.index'));
