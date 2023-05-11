<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('v1/airports', [\App\Http\Controllers\Api\AirportController::class, 'createAirport']);
Route::delete('v1/airports/{id}', [\App\Http\Controllers\Api\AirportController::class, 'deleteAirport']);
Route::get('v1/airports/{id}', [\App\Http\Controllers\Api\AirportController::class, 'getAirport']);
Route::patch('v1/airports/{id}', [\App\Http\Controllers\Api\AirportController::class, 'patchAirport']);
Route::put('v1/airports/{id}', [\App\Http\Controllers\Api\AirportController::class, 'updateAirport']);
Route::post('v1/airports:search', [\App\Http\Controllers\Api\AirportController::class, 'filterAirports']);

Route::post('v1/flights', [\App\Http\Controllers\Api\FlightController::class, 'createFlight']);
Route::delete('v1/flights/{id}', [\App\Http\Controllers\Api\FlightController::class, 'deleteFlight']);
Route::patch('v1/flights/{id}', [\App\Http\Controllers\Api\FlightController::class, 'patchFlight']);
Route::put('v1/flights/{id}', [\App\Http\Controllers\Api\FlightController::class, 'updateFlight']);
Route::get('v1/flights/{id}', [\App\Http\Controllers\Api\FlightController::class, 'getFlight']);
Route::post('v1/flights:search', [\App\Http\Controllers\Api\FlightController::class, 'filterFlights']);
