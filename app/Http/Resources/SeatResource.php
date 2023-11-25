<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeatResource extends JsonResource
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
            'seat_number' => $this->seat_number,
            'price' => $this->price,
            'flight_class_type' => $this->flightClass?->flightClassType?->name,
            'flight_number' => $this->flightClass?->flight?->flight_number,
            'departure_date' => $this->flightClass?->flight?->departure_date->format('d/m/Y H:i:s'),
            'flight_origin_airport' => $this->flightClass?->flight?->flightOriginAirport?->name,
            'flight_origin_airport_city' => $this->flightClass?->flight?->flightOriginAirport?->city->name,
            'flight_destination_airport' => $this->flightClass?->flight?->flightDestinationAirport?->name,
            'flight_destination_airport_city' => $this->flightClass?->flight?->flightDestinationAirport?->city->name,
        ];
    }
}
