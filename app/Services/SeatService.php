<?php

namespace App\Services;

use App\Helpers\NumberGenerator;
use App\Http\Resources\SeatCollection;
use App\Models\FlightClass;
use App\Repositories\Interface\FlightRepositoryInterface;
use App\Repositories\Interface\SeatRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeatService
{
    public function __construct(private readonly SeatRepositoryInterface $repository, private readonly FlightRepositoryInterface $flightRepository)
    {
    }

    public function getAll(array $data)
    {
        return new SeatCollection($this->repository->getAll($data));
    }

    public function store(array $data)
    {
        $flight = $this->flightRepository->findById($data['flight_id']);
        $flightClass = $flight->flightClass()->where('flight_class_type_id', '=', $data['flight_class_type_id'])->first();
        if (is_null($flightClass)) {
            throw new \DomainException("O voo não possui o tipo de classe inserido");
        }
        $countSeats = $flightClass->seats()->count();
        $this->validateFlightSeats($flightClass, $countSeats);
        $data['seat_number'] = NumberGenerator::generatorRandomDigit();
        $data['flight_class_id'] = $flightClass->id;
        $this->repository->store($data);
    }

    public function update(array $data, int $id)
    {
        $seat = $this->repository->findById($id);
        $this->repository->update($seat, $data);
    }

    /**
     * @param FlightClass $flightClass
     * @param int $countSeats
     * @return void
     */
    public function validateFlightSeats(FlightClass $flightClass, int $countSeats): void
    {
        if ($countSeats >= $flightClass->seats_qty) {
            throw new \DomainException("A classe do voo já atingiu o limite máximo de assentos");
        }
    }
}
