<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightClassResource extends JsonResource
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
            'quantidade_assentos' => $this->seats_qty,
            'tipo_classe' => $this->flightClassType?->name,
            'assentos' => SeatResource::collection($this->seats)
        ];
    }
}
