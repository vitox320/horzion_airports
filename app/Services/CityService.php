<?php

namespace App\Services;

use App\Repositories\Interface\CityRepositoryInterface;

class CityService
{
    public function __construct(private readonly CityRepositoryInterface $repository)
    {
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }
}
