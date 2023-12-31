<?php

namespace App\Repositories\Interface;

use App\Models\Seat;

interface SeatRepositoryInterface
{
    public function getPassengersByFlight(int $id);

    public function getAll(array $data);

    public function store(array $data);

    public function findById(int $id);

    public function update(Seat $seat, array $data);
}
