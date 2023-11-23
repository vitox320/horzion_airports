<?php

use App\Http\Controllers\AirportController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;
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

Route::post('/auth/login/', [UserController::class, 'login']);

Route::middleware(['auth:sanctum', 'abilities:manager_ability'])->group(function () {

    Route::prefix('/city')->group(function () {
        Route::get('/', [CityController::class, 'getAll']);
    });

    Route::prefix('/airport')->group(function () {
        Route::get('/', [AirportController::class, 'getAll']);
    });

    Route::prefix('flight')->group(function () {
        Route::post('/', [FlightController::class, 'store']);
    });
});
