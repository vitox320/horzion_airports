<?php

namespace App\Services;

use App\Repositories\Interface\AirportRepositoryInterface;

class AirportService
{
    public function __construct(private readonly AirportRepositoryInterface $repository)
    {
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }
}
