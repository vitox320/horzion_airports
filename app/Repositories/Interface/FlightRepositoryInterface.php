<?php

namespace App\Repositories\Interface;

use App\Models\Flight;

interface FlightRepositoryInterface
{
    public function getAll();

    public function store(array $data);

    public function update(Flight $flight, array $data);

    public function findById(int $id): Flight;

    public function delete(Flight $flight);

    public function restore(Flight $flight);
}
