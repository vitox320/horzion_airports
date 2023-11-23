<?php

namespace App\Http\Controllers;

use App\Services\AirportService;
use App\Traits\Response;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    use Response;
    public function __construct(private readonly AirportService $service)
    {
    }

    public function getAll(): \Illuminate\Http\JsonResponse
    {
        return $this->apiResponse(['data' => $this->service->getAll()]);
    }


}
