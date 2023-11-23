<?php

namespace App\Http\Controllers;

use App\Services\CityService;
use App\Traits\Response;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use Response;
    public function __construct(private CityService $service)
    {
    }

    public function getAll(): \Illuminate\Http\JsonResponse
    {
        return $this->apiResponse(['data' => $this->service->getAll()]);
    }
}
