<?php

namespace App\Repositories\Eloquent;

use App\Models\Passenger;
use App\Repositories\Interface\PassengerRepositoryInterface;

class PassengerRepository implements PassengerRepositoryInterface
{
    public function __construct(private readonly Passenger $entity)
    {
    }

    public function store(array $data)
    {
        return $this->entity::create($data);
    }
}
