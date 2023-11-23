<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use App\Traits\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Response;

    public function __construct(private readonly UserService $service)
    {
    }

    public function login(LoginRequest $request)
    {
        $login = $this->service->login($request->all());
        return $this->apiResponse(['message' => 'Login realizado com sucesso!', 'access_token' => $login['token'], 'token_type' => 'Bearer']);
    }
}
