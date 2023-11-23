<?php

namespace App\Repositories\Eloquent;

use App\Models\Flight;
use App\Repositories\Interface\FlightRepositoryInterface;

class FlightRepository implements FlightRepositoryInterface
{

    public function __construct(private Flight $entity)
    {
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->entity::query()->get();
    }


    public function store(array $data)
    {
        return $this->entity::create($data);
    }

    public function update(Flight $flight, array $data): void
    {
        $flight->update($data);
    }

    public function findById(int $id): Flight
    {
        return $this->entity::withTrashed()->find($id);
    }

    public function delete(Flight $flight): void
    {
        $flight->delete();
    }

    public function restore(Flight $flight): void
    {
        $flight->restore();
    }
}
