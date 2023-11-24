<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeatRequest;
use App\Services\SeatService;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    use Response;

    public function __construct(private readonly SeatService $service)
    {
    }

    public function store(SeatRequest $request): JsonResponse
    {
        $this->service->store($request->all());
        return $this->apiResponse(['message' => 'Registro inserido com sucesso'], 201);
    }

    public function update(SeatRequest $request, int $id): JsonResponse
    {
        $this->service->update($request->all(), $id);
        return $this->apiResponse(['message' => 'Registro atualizado com sucesso']);
    }
}
