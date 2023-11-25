<?php

use App\Http\Controllers\AirportController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FlightClassTypeController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TicketController;
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

Route::prefix('/tickets')->group(function () {
    Route::post('/', [TicketController::class, 'store']);
    Route::get('/get-by-cpf', [TicketController::class, 'getTicketsByCpfPurchaser']);
    Route::get('/voucher', [TicketController::class, 'generateVoucher']);
    Route::get('/baggage-ticket', [TicketController::class, 'generateBaggageTicket']);
    Route::delete('/{id}', [TicketController::class, 'delete']);
});

Route::get('/flight/seats/', [SeatController::class, 'getAll']);

Route::prefix('flight-class-type')->group(function () {
    Route::get('/', [FlightClassTypeController::class, 'getAll']);
});

Route::middleware(['auth:sanctum', 'abilities:manager_ability'])->group(function () {

    Route::prefix('/city')->group(function () {
        Route::get('/', [CityController::class, 'getAll']);
    });

    Route::prefix('/airport')->group(function () {
        Route::get('/', [AirportController::class, 'getAll']);
    });

    Route::prefix('/seats')->group(function () {
        Route::post('/', [SeatController::class, 'store']);
        Route::put('/{id}', [SeatController::class, 'update']);
    });

    Route::prefix('flight')->group(function () {
        Route::get('/', [FlightController::class, 'getAll']);
        Route::get('/passengers/{id}', [FlightController::class, 'getPassengersByFlight']);
        Route::post('/', [FlightController::class, 'store']);
        Route::put('/{id}', [FlightController::class, 'update']);
        Route::delete('/{id}', [FlightController::class, 'delete']);
    });
});
