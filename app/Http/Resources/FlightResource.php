<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
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
            'departure_date' => $this->departure_date->format('d/m/Y H:i'),
            'flight_number' => $this->flight_number,
            'flight_origin_airport' => $this->flightOriginAirport?->name,
            'flight_destination_airport' => $this->flightDestinationAirport?->name,
            'classes' => FlightClassResource::collection($this->flightClass)
        ];
    }
}
