<?php

namespace App\Repositories\Interface;

use App\Models\Flight;
use App\Models\FlightClass;

interface FlightClassRepositoryInterface
{
    public function getAll();

    public function store(array $data);

    public function storeByFlight(Flight $flight, array $data);

    public function update(FlightClass $flightClass, array $data);

    public function findById(int $id): FlightClass;

    public function delete(FlightClass $flightClass);

    public function restore(FlightClass $flightClass);
}
