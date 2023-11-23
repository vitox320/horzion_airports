<?php

namespace App\Repositories\Eloquent;

use App\Models\Airport;
use App\Repositories\Interface\AirportRepositoryInterface;

class AirportRepository implements AirportRepositoryInterface
{

    public function __construct(private readonly Airport $entity)
    {
    }

    public function getAll()
    {
        return $this->entity::query()->get();
    }

    public function findById(int $id)
    {
        return $this->entity::find($id);
    }
}
