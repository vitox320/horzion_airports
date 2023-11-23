<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function __construct(private readonly User $entity)
    {
    }

    public function getAll()
    {
        return $this->entity::query()->get();
    }

    public function store(array $data)
    {
        $this->entity::create($data);
    }

    public function findById(int $id)
    {
        return $this->entity::findOrFail($id);
    }

    public function findByEmail(string $email)
    {
        return $this->entity::where('email', '=', $email)->first();
    }
}
