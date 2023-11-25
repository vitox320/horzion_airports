<?php

namespace App\Repositories\Interface;

use App\Models\Ticket;
use App\ValueObjects\Cpf;

interface TicketRepositoryInterface
{
    public function getTicketByCpfPassenger(Cpf $cpf);
    public function getTicketsByCpfPurchaser(Cpf $cpf);
    public function store(array $data);

    public function findById(int $id);
    public function delete(Ticket $ticket);
}
