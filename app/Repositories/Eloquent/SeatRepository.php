<?php

namespace App\Repositories\Eloquent;

use App\Models\Seat;
use App\Repositories\Interface\SeatRepositoryInterface;

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

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }
}
