<?php

namespace App\Repositories\Eloquent;

use App\Models\Ticket;
use App\Repositories\Interface\TicketRepositoryInterface;

class TicketRepository implements TicketRepositoryInterface
{
    public function __construct(private readonly Ticket $entity)
    {
    }

    public function store(array $data)
    {
        return $this->entity::create($data);
    }

    public function delete(Ticket $ticket)
    {
        $ticket->delete();
    }

    public function findById(int $id)
    {
        return $this->entity::find($id);
    }
}
