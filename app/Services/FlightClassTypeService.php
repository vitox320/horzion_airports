<?php

namespace App\Services;

use App\Repositories\Interface\FlightClassTypeRepositoryInterface;

class FlightClassTypeService
{
    public function __construct(private readonly FlightClassTypeRepositoryInterface $repository)
    {
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }
}
