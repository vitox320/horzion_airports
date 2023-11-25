<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Services\FlightService;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    use Response;

    public function __construct(private readonly FlightService $service)
    {
    }


    public function getPassengersByFlight(int $id)
    {
        return $this->service->getPassengersByFlight($id);
    }

    public function getAll(): JsonResponse
    {
        return $this->apiResponse(['data' => $this->service->getAll()]);
    }

    /**
     * @throws \Exception
     */
    public function store(FlightRequest $request): JsonResponse
    {
        $this->service->store($request->all());
        return $this->apiResponse(['message' => 'Registro inserido com sucesso.'], 201);
    }

    /**
     * @throws \Exception
     */
    public function update(FlightRequest $request, int $id): JsonResponse
    {
        $this->service->update($request->all(), $id);
        return $this->apiResponse(['message' => 'Registro atualizado com sucesso.']);
    }

    public function delete(int $id): JsonResponse
    {
        $this->service->delete($id);
        return $this->apiResponse(['message' => 'Registro desativado com sucesso.']);
    }
}
