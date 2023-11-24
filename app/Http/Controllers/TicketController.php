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

    public function store(TicketRequest $request)
    {
        $this->service->store($request->all());
        return $this->apiResponse(['message' => 'Registro inserido com sucesso'], 201);
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return $this->apiResponse(['message' => 'Registro deletado com sucesso']);
    }
}
