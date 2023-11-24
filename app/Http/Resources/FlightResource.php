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
            'Número de voo' => $this->flight_number,
            'aeroporto_origem' => $this->flightOriginAirport?->name,
            'aeroporto_destino' => $this->flightDestinationAirport?->name,
            'classes' => FlightClassResource::collection($this->flightClass)
        ];
    }
}
