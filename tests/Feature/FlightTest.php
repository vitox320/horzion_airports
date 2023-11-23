<?php

namespace Tests\Feature;

use App\Models\Airport;
use App\Models\City;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class FlightTest extends TestCase
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

    public function testIfFlightCannotHaveSameAirportOriginAndAirportDestination(): void
    {
        $airportCreated = Airport::factory()->create();

        $requestData = [
            'departure_date' => '24/11/2023 10:13',
            'flight_origin_id' => $airportCreated->id,
            'flight_destination_id' => $airportCreated->id,
            'flight_class' => [
                [
                    'seats_qty' => 20,
                    'flight_class_type_id' => 1,
                    'price' => 50.00
                ]
            ]
        ];

        $response = $this->post('/api/flight/', $requestData);
        $response->assertSee('Os campos flight origin id e flight destination id devem ser diferentes');
        $response->assertStatus(422);
    }

    public function testIfFlightCannotHaveAirportsInTheSameCity()
    {
        $cityCreated = City::factory()->create(['name' => 'SALVADOR', 'uf' => 'BA']);

        $airportOriginCreated = Airport::factory()->for($cityCreated)->create([
            'name' => 'Aeroporto São Salvador',
            'airport_code' => 'ASS'
        ]);

        $airportDestinationCreated = Airport::factory()->for($cityCreated)->create([
            'name' => 'Aeroporto Internacional de Salvador',
            'airport_code' => 'AIS'
        ]);

        $requestData = [
            'departure_date' => '24/11/2023 10:13',
            'flight_origin_id' => $airportOriginCreated->id,
            'flight_destination_id' => $airportDestinationCreated->id,
            'flight_class' => [
                [
                    'seats_qty' => 20,
                    'flight_class_type_id' => 1,
                    'price' => 50.00
                ]
            ]
        ];

        $response = $this->post('/api/flight/', $requestData);
        $response->assertSee('Os aeroportos de origem e destino não podem estar situados na mesma cidade');
        $response->assertStatus(500);
    }

    public function testIfFlightCannotBeCreatedWithFlightClassTypeDuplicated()
    {
        $airPorts = Airport::factory()->count(2)->create()->toArray();

        $requestData = [
            'departure_date' => '24/11/2023 10:13',
            'flight_origin_id' => $airPorts[0]['id'],
            'flight_destination_id' => $airPorts[1]['id'],
            'flight_class' => [
                [
                    'seats_qty' => 20,
                    'flight_class_type_id' => 1,
                    'price' => 50
                ],
                [
                    'seats_qty' => 15,
                    'flight_class_type_id' => 1,
                    'price' => 25
                ],
            ]
        ];

        $response = $this->post('/api/flight/', $requestData);
        $response->assertSee('Não é permitido haver duas ou mais classes do mesmo tipo no mesmo voo');
        $response->assertStatus(500);
    }

    public function testIfFlightCanBeCreated()
    {
        $airPorts = Airport::factory()->count(2)->create()->toArray();

        $requestData = [
            'departure_date' => '24/11/2023 10:13',
            'flight_origin_id' => $airPorts[0]['id'],
            'flight_destination_id' => $airPorts[1]['id'],
            'flight_class' => [
                [
                    'seats_qty' => 20,
                    'flight_class_type_id' => 1,
                    'price' => 50
                ]
            ]
        ];

        $response = $this->post('/api/flight/', $requestData);
        $response->assertSee('Registro inserido com sucesso');
        $response->assertStatus(201);
    }

    protected function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }
}
