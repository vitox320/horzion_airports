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
            'seats_qty' => $this->seats_qty,
            'flight_class_type' => $this->flightClassType?->name,
            'seats' => SeatResource::collection($this->seats)
        ];
    }
}
