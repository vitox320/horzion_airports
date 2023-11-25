<?php

namespace App\Services;

use App\Helpers\DateGenerator;
use App\Helpers\NumberGenerator;
use App\Http\Resources\FlightCollection;
use App\Http\Resources\SeatCollection;
use App\Http\Resources\SeatTicketPassengerCollection;
use App\Models\Seat;
use App\Repositories\Interface\AirportRepositoryInterface;
use App\Repositories\Interface\FlightClassRepositoryInterface;
use App\Repositories\Interface\FlightRepositoryInterface;
use App\Repositories\Interface\SeatRepositoryInterface;

class FlightService
{


    public function __construct(
        private readonly FlightRepositoryInterface      $repository,
        private readonly AirportRepositoryInterface     $airportRepository,
        private readonly FlightClassRepositoryInterface $flightClassRepository,
        private readonly SeatRepositoryInterface        $seatRepository,
        private readonly DateGenerator                  $dateGenerator
    )
    {

    }

    public function getPassengersByFlight(int $id): SeatTicketPassengerCollection
    {
        return new SeatTicketPassengerCollection($this->seatRepository->getPassengersByFlight($id));
    }

    public function getAll()
    {
        return new FlightCollection($this->repository->getAll());
    }

    /**
     * @throws \Exception
     */
    public function store(array $data): void
    {
        $data['departure_date'] = $this->getDateTimeFormat($data['departure_date']);
        $this->verifyIfAirportBelongsToTheSameCity($data['flight_origin_id'], $data['flight_destination_id']);
        $data['flight_number'] = NumberGenerator::generatorRandomDigit();
        $flight = $this->repository->store($data);
        $this->flightClassRepository->storeByFlight($flight, $data);
    }

    /**
     * @throws \Exception
     */
    public function update(array $data, int $id): void
    {
        $data['departure_date'] = $this->getDateTimeFormat($data['departure_date']);
        $this->verifyIfAirportBelongsToTheSameCity($data['flight_origin_id'], $data['flight_destination_id']);
        $flight = $this->repository->findById($id);
        $flight->fill($data);
        $flight->update($data);
    }

    public function delete(int $id): void
    {
        $flight = $this->repository->findById($id);
        $this->repository->delete($flight);
    }

    /**
     * @param int $flight_origin_id
     * @param int $flight_destination_id
     * @return void
     * @throws \Exception
     */
    public function verifyIfAirportBelongsToTheSameCity(int $flight_origin_id, int $flight_destination_id): void
    {
        $flightOrigin = $this->airportRepository->findById($flight_origin_id);
        $flightDestination = $this->airportRepository->findById($flight_destination_id);
        if ($flightOrigin->city?->id == $flightDestination->city?->id) {
            throw new \DomainException('Os aeroportos de origem e destino não podem estar situados na mesma cidade');
        }
    }

    /**
     * @param $departure_date
     * @return string
     */
    public function getDateTimeFormat($departure_date): string
    {
        return $this->dateGenerator->getDateTimeFormat($departure_date);
    }
}
