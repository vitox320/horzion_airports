<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Services\FlightService;
use App\Traits\Response;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    use Response;

    public function __construct(private readonly FlightService $service)
    {
    }

    public function getAll(): \Illuminate\Http\JsonResponse
    {
        return $this->apiResponse(['data' => $this->service->getAll()]);
    }

    public function store(FlightRequest $request)
    {
        $this->service->store($request->all());
        return $this->apiResponse(['message' => 'Registro inserido com sucesso.'],201);
    }
}
