<?php

namespace Tests\Feature;

use App\Models\Airport;
use App\Models\Flight;
use App\Models\FlightClass;
use App\Models\FlightClassType;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SeatTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    }


    public function testIfSeatsCanBeCreated(): void
    {
        $flightClassType = FlightClassType::factory()->create(['name' => 'Primeira Classe']);
        $flight = Flight::factory()
            ->for(Airport::factory()->create(), 'flightOriginAirport')
            ->for(Airport::factory()->create(), 'flightDestinationAirport')
            ->has(FlightClass::factory()
                ->for($flightClassType)
                ->has(Seat::factory()->count(4))
                ->count(1))
            ->create();

        $requestData = [
            'flight_id' => $flight->id,
            'flight_class_type_id' => $flightClassType->id,
            'price' => 40
        ];

        $response = $this->post('api/seats/', $requestData);
        $response->assertSee('Registro inserido com sucesso');
        $response->assertStatus(201);
    }

    public function testIfSeatCanBeUpdated()
    {
        $seat = Seat::factory()
            ->for(FlightClass::factory()
                ->for(FlightClassType::factory()->create(['name' => 'Primeira classe']))
                ->for(Flight::factory()
                    ->for(Airport::factory()->create(), 'flightOriginAirport')
                    ->for(Airport::factory()->create(), 'flightDestinationAirport')
                    ->create()))
            ->create();

        $requestData = [
            'price' => 20
        ];

        $response = $this->put("api/seats/$seat->id", $requestData);
        $response->assertSee('Registro atualizado com sucesso');
        $response->assertOk();
        $seatUpdated = Seat::find($seat->id);
        $this->assertEquals($requestData['price'], $seatUpdated->price);

    }

    protected function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }
}
