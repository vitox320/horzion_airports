<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'purchaser' => $this->purchaser?->name,
            'purchaser_email' => $this->purchaser?->email,
            'purchaser_cpf' => $this->purchaser?->cpf,
            'purchaser_birth_date' => $this->purchaser?->birth_date,
            'passenger' => $this->passenger?->name,
            'ticket_number' => $this->ticket_number,
            'total price' => $this->price,
            'has_baggage_exceeded' => $this->has_baggage_exceeded ? 'SIM' : 'NÃO',
            'departure_date' => $this->seat?->flightClass?->flight?->departure_date->format('d/m/Y H:i:s'),
            'flight_origin_airport' => $this->seat?->flightClass?->flight?->flightOriginAirport?->name,
            'flight_origin_airport_city' => $this->seat?->flightClass?->flight?->flightOriginAirport?->city->name,
            'flight_destination_airport' => $this->seat?->flightClass?->flight?->flightDestinationAirport?->name,
            'flight_destination_airport_city' => $this->seat?->flightClass?->flight?->flightDestinationAirport?->city->name,
        ];
    }
}
