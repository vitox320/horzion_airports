<?php

namespace App\Services;

use App\Repositories\Interface\UserRepositoryInterface;
use App\ValueObjects\Cpf;
use App\ValueObjects\Email;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }


    /**
     * @throws \Exception
     */
    public function login(array $data)
    {
        $data['email'] = (string)new Email($data['email']);
        $user = $this->repository->findByEmail($data['email']);

        if (is_null($user)) {
            throw new \Exception('Usuário não encontrado na base de dados', 401);
        }

        if (!Hash::check($data['password'], $user->password)) {
            throw new \Exception('Credenciais Inválidas', 401);
        }

        return [
            'token' => $user->createToken('auth_token', ['manager_ability'])->plainTextToken
        ];

    }

    public function store(array $data)
    {
        $data['cpf'] = (string)new Cpf($data['cpf']);
        $data['email'] = (string)new Email($data['email']);
        $this->repository->store($data);
    }
}
