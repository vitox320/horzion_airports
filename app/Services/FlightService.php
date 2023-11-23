<?php

namespace App\Services;

use App\Helpers\NumberGenerator;
use App\Repositories\Interface\AirportRepositoryInterface;
use App\Repositories\Interface\FlightClassRepositoryInterface;
use App\Repositories\Interface\FlightRepositoryInterface;

class FlightService
{
    public function __construct(
        private readonly FlightRepositoryInterface      $repository,
        private readonly AirportRepositoryInterface     $airportRepository,
        private readonly FlightClassRepositoryInterface $flightClassRepository
    )
    {
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * @throws \Exception
     */
    public function store(array $data)
    {
        $this->verifyIfAirportBelongsToTheSameCity($data['flight_origin_id'], $data['flight_destination_id']);
        $data['flight_number'] = NumberGenerator::generatorRandomDigit();
        $data['departure_date'] = \DateTime::createFromFormat('d/m/Y H:i', $data['departure_date'])->format('Y-m-d H:i:s');
        $flight = $this->repository->store($data);
        $this->flightClassRepository->storeByFlight($flight, $data);
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
}
