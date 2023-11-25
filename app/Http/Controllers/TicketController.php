<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Services\TicketService;
use App\Traits\Response;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    use Response;

    public function __construct(private readonly TicketService $service)
    {
    }

    public function getTicketsByCpfPurchaser(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'cpf' => 'required|cpf'
        ]);

        return $this->apiResponse(['data' => $this->service->getTicketsByCpfPurchaser($request->all())]);
    }

    public function store(TicketRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->service->store($request->all());
        return $this->apiResponse(['message' => 'Registro inserido com sucesso'], 201);
    }

    public function delete(int $id): \Illuminate\Http\JsonResponse
    {
        $this->service->delete($id);
        return $this->apiResponse(['message' => 'Registro deletado com sucesso']);
    }
}
