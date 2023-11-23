<?php

namespace App\Repositories\Eloquent;

use App\Models\City;
use App\Repositories\Interface\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface
{
    public function __construct(private readonly City $entity)
    {
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->entity::query()->get();
    }
}
