<?php

namespace App\Repositories\Eloquent;

use App\Models\Seat;
use App\Repositories\Interface\SeatRepositoryInterface;
use Carbon\Carbon;

class SeatRepository implements SeatRepositoryInterface
{
    public function __construct(private readonly Seat $entity)
    {
    }

    public function store(array $data)
    {
        $this->entity::create($data);
    }

    public function update(Seat $seat, array $data)
    {
        $seat->update($data);
    }

    public function findById(int $id)
    {
        return $this->entity::find($id);
    }

    public function getAll(array $data)
    {
        $query = $this->entity::query()->with(['flightClass', 'flightClass.flightClassType', 'flightClass.flight', 'flightClass.flight.flightOriginAirport', 'flightClass.flight.flightDestinationAirport']);
        if (isset($data['airport_origin_name'])) {
            $query->whereHas('flightClass', function ($query) use ($data) {
                $query->whereHas('flight', function ($query) use ($data) {
                    $query->whereHas('flightOriginAirport', function ($query) use ($data) {
                        $data['airport_origin_name'] = mb_strtoupper($data['airport_origin_name']);
                        $query->whereRaw('UPPER(name) LIKE ?', ['%' . $data['airport_origin_name'] . '%']);
                    });
                });
            });
        }
        if (isset($data['airport_destination_name'])) {
            $query->whereHas('flightClass', function ($query) use ($data) {
                $query->whereHas('flight', function ($query) use ($data) {
                    $query->whereHas('flightDestinationAirport', function ($query) use ($data) {
                        $data['airport_destination_name'] = mb_strtoupper($data['airport_destination_name']);
                        $query->whereRaw('UPPER(name) LIKE ?', ['%' . $data['airport_destination_name'] . '%']);
                    });
                });
            });
        }


        $query->whereHas('flightClass', function ($query) use ($data) {
            $query->whereHas('flight', function ($query) use ($data) {
                $query->whereDate('departure_date', '>=', Carbon::now()->format('Y-m-d'));
            });
        });


        return $query->whereDoesntHave('ticket')->get();
    }
}
