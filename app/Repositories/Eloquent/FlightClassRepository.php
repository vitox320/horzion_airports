<?php

namespace App\Repositories\Eloquent;

use App\Models\Flight;
use App\Models\FlightClass;
use App\Repositories\Interface\FlightClassRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FlightClassRepository implements FlightClassRepositoryInterface
{
    public function __construct(private readonly FlightClass $entity)
    {
    }

    public function getAll()
    {
        return $this->entity::query()->get();
    }

    public function storeByFlight(Flight $flight, array $data): void
    {
        DB::transaction(function () use ($data, $flight) {
            foreach ($data['flight_class'] as &$flightClassArray) {
                $flightClassArray['flight_id'] = $flight->id;
                $this->verifyIfExistsFlightClassWithTheSameFlightClassType($flightClassArray['flight_class_type_id'], $flight);
                $flightClass = $this->entity::create($flightClassArray);
                $factorySeats = $this->factorySeats($flightClass, $flightClassArray);
                $flightClass->seats()->createMany($factorySeats);
            }
        });
    }

    public function verifyIfExistsFlightClassWithTheSameFlightClassType(int $flightClassTypeId, Flight $flight): void
    {
        $flightClassQuery = $flight->flightClass()
            ->where('flight_class_type_id', '=', $flightClassTypeId)
            ->first();
        if (!is_null($flightClassQuery)) {
            throw new \DomainException("Não é permitido haver duas ou mais classes do mesmo tipo no mesmo voo");
        }
    }

    private function factorySeats(FlightClass $flightClass, array $data): array
    {
        $seats = [];

        for ($i = 0; $i < $flightClass->seats_qty; $i++) {
            $seats[$i]['seat_number'] = $i;
            $seats[$i]['price'] = $data['price'];
            $seats[$i]['flight_class_id'] = $flightClass->id;
        }
        return $seats;
    }

    public function store(array $data)
    {
        return $this->entity::create($data);
    }


    public function update(FlightClass $flightClass, array $data)
    {
        $flightClass->update($data);
    }

    public function findById(int $id): FlightClass
    {
        return $this->entity::findOrFail($id);
    }

    public function delete(FlightClass $flightClass)
    {
        $flightClass->delete();
    }

    public function restore(FlightClass $flightClass)
    {
        $flightClass->restore();
    }


}
