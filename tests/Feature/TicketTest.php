<?php

namespace Tests\Feature;

use App\Models\Airport;
use App\Models\Flight;
use App\Models\FlightClass;
use App\Models\FlightClassType;
use App\Models\Passenger;
use App\Models\Seat;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TicketTest extends TestCase
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


    public function testIfTicketCanBeCreated(): void
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
            'purchaser' => [
                'name' => 'Victor Teste',
                'email' => 'teste@gmail.com',
                'cpf' => '672.382.690-66',
                'birth_date' => '25/06/1994',
            ],
            'qty_tickets' => 1,
            'seat_id' => $seat->id,
            'has_baggage_exceeded' => false,
        ];

        $response = $this->post('/api/tickets', $requestData);
        $response->assertSee('Registro inserido com sucesso');
        $response->assertStatus(201);
    }

    public function testIfTicketCanBeCreatedWitHManyPassengers()
    {
        $seat = Seat::factory()
            ->for(FlightClass::factory()
                ->for(FlightClassType::factory()->create(['name' => 'Primeira classe']))
                ->for(Flight::factory()
                    ->for(Airport::factory()->create(), 'flightOriginAirport')
                    ->for(Airport::factory()->create(), 'flightDestinationAirport')
                    ->create()))
            ->count(3)->create();

        $requestData = [
            'purchaser' => [
                'name' => 'Victor Teste',
                'email' => 'teste@gmail.com',
                'cpf' => '672.382.690-66',
                'birth_date' => '25/06/1994',
            ],
            'qty_tickets' => 3,
            'has_baggage_exceeded' => false,
            'seat_id' => $seat->toArray()[0]['id'],
            'passengers' => [
                [
                    'name' => 'Fernanda Lima',
                    'email' => 'fernandalima@gmail.com',
                    'cpf' => '547.386.150-41',
                    'birth_date' => '25/06/1994',
                    'has_baggage_exceeded' => false,
                    'seat_id' => $seat->toArray()[1]['id'],
                ],
                [
                    'name' => 'Ricardo Silva',
                    'email' => 'ricardosilva@gmail.com',
                    'cpf' => '547.386.150-41',
                    'birth_date' => '25/06/1994',
                    'has_baggage_exceeded' => false,
                    'seat_id' => $seat->toArray()[2]['id'],
                ],
            ]
        ];

        $response = $this->post('/api/tickets', $requestData);
        $response->assertSee('Registro inserido com sucesso');
        $response->assertStatus(201);
    }

    public function testIfTicketCanBeCreatedWitHManyPassengersAndBaggages()
    {
        $seat = Seat::factory()
            ->for(FlightClass::factory()
                ->for(FlightClassType::factory()->create(['name' => 'Primeira classe']))
                ->for(Flight::factory()
                    ->for(Airport::factory()->create(), 'flightOriginAirport')
                    ->for(Airport::factory()->create(), 'flightDestinationAirport')
                    ->create()))
            ->count(3)->create();

        $requestData = [
            'purchaser' => [
                'name' => 'Victor Teste',
                'email' => 'teste@gmail.com',
                'cpf' => '672.382.690-66',
                'birth_date' => '25/06/1994',
            ],
            'qty_tickets' => 3,
            'has_baggage_exceeded' => true,
            'seat_id' => $seat->toArray()[0]['id'],
            'passengers' => [
                [
                    'name' => 'Fernanda Lima',
                    'email' => 'fernandalima@gmail.com',
                    'cpf' => '547.386.150-41',
                    'birth_date' => '25/06/1994',
                    'has_baggage_exceeded' => true,
                    'seat_id' => $seat->toArray()[1]['id'],
                ],
                [
                    'name' => 'Ricardo Silva',
                    'email' => 'ricardosilva@gmail.com',
                    'cpf' => '547.386.150-41',
                    'birth_date' => '25/06/1994',
                    'has_baggage_exceeded' => true,
                    'seat_id' => $seat->toArray()[2]['id'],
                ],
            ]
        ];

        $response = $this->post('/api/tickets', $requestData);
        $response->assertSee('Registro inserido com sucesso');
        $response->assertStatus(201);
    }


    public function testIfTicketCanBeDeleted()
    {
        $ticket = Ticket::factory()->for(Seat::factory()
            ->for(FlightClass::factory()
                ->for(FlightClassType::factory()->create(['name' => 'Primeira classe']))
                ->for(Flight::factory()
                    ->for(Airport::factory()->create(), 'flightOriginAirport')
                    ->for(Airport::factory()->create(), 'flightDestinationAirport')
                    ->create()))
            ->create()
        )
            ->for(Passenger::factory()->create(), 'passenger')
            ->for(Passenger::factory()->create(), 'purchaser')
            ->create();


        $response = $this->delete("api/tickets/$ticket->id");
        $response->assertSee('Registro deletado com sucesso');
        $response->assertOk();
        $this->assertSoftDeleted(Ticket::class, ['id' => $ticket->id]);
    }

    protected function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }
}
