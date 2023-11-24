<?php

namespace App\Repositories\Interface;

use App\Models\Ticket;

interface TicketRepositoryInterface
{
    public function store(array $data);

    public function findById(int $id);
    public function delete(Ticket $ticket);
}
