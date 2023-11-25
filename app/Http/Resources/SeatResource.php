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
            'Número do assento' => $this->seat_number,
            'Preço' => $this->price,
            'Classe Do Voo' => $this->flightClass?->flightClassType?->name,
            'Número do voo' => $this->flightClass?->flight?->flight_number,
            'Data de partida' => $this->flightClass?->flight?->departure_date->format('d/m/Y H:i:s'),
            'Origem' => $this->flightClass?->flight?->flightOriginAirport?->name,
            'Cidade Origem' => $this->flightClass?->flight?->flightOriginAirport?->city->name,
            'Destino' => $this->flightClass?->flight?->flightDestinationAirport?->name,
            'Cidade Destino' => $this->flightClass?->flight?->flightDestinationAirport?->city->name,
        ];
    }
}
