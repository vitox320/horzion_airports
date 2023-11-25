<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketByCpfValidateRequest;
use App\Http\Requests\TicketRequest;
use App\Services\TicketService;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    use Response;

    public function __construct(private readonly TicketService $service)
    {
    }

    public function generateBaggageTicket(TicketByCpfValidateRequest $request): JsonResponse
    {
        return $this->apiResponse(['data' => $this->service->generateBaggageTicket($request->all())]);
    }

    public function generateVoucher(TicketByCpfValidateRequest $request): JsonResponse
    {
        return $this->apiResponse(['data' => $this->service->generateVoucher($request->all())]);
    }
    public function getTicketsByCpfPurchaser(TicketByCpfValidateRequest $request): JsonResponse
    {
        return $this->apiResponse(['data' => $this->service->getTicketsByCpfPurchaser($request->all())]);
    }

    public function store(TicketRequest $request): JsonResponse
    {
        $this->service->store($request->all());
        return $this->apiResponse(['message' => 'Registro inserido com sucesso'], 201);
    }

    public function delete(int $id): JsonResponse
    {
        $this->service->delete($id);
        return $this->apiResponse(['message' => 'Registro deletado com sucesso']);
    }
}
