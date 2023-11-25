<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeatTicketPassengerResource extends JsonResource
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
            'flight_number' => $this->flightClass?->flight->flight_number,
            'flight_origin_airport' => $this->flightClass?->flight->flightOriginAirport?->name,
            'flight_destination_airport' => $this->flightClass?->flight->flightDestinationAirport?->name,
            'passenger' => $this->ticket?->passenger?->name,
        ];
    }
}
