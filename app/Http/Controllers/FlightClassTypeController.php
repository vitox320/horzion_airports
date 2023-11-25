<?php

namespace App\Http\Controllers;

use App\Services\FlightClassTypeService;
use App\Traits\Response;
use Illuminate\Http\Request;

class FlightClassTypeController extends Controller
{
    use Response;

    public function __construct(private readonly FlightClassTypeService $service)
    {
    }

    public function getAll()
    {
        return $this->apiResponse(['data' => $this->service->getAll()]);
    }
}
