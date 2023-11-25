<?php

namespace App\Repositories\Eloquent;

use App\Models\FlightClassType;
use App\Repositories\Interface\FlightClassTypeRepositoryInterface;

class FlightClassTypeRepository implements FlightClassTypeRepositoryInterface
{
    public function __construct(private readonly FlightClassType $entity)
    {
    }

    public function getAll()
    {
        return $this->entity::query()->get();
    }
}
