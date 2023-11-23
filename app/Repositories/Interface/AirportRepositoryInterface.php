<?php

namespace App\Repositories\Interface;

interface AirportRepositoryInterface
{
    public function getAll();

    public function findById(int $id);
}
