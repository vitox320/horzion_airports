<?php

namespace App\Repositories\Interface;

use App\ValueObjects\Cpf;

interface UserRepositoryInterface
{
    public function getAll();

    public function store(array $data);

    public function findById(int $id);
    public function findByEmail(string $email);

}
