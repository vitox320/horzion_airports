<?php

namespace App\Repositories\Eloquent;

use App\Models\Ticket;
use App\Repositories\Interface\TicketRepositoryInterface;
use App\ValueObjects\Cpf;

class TicketRepository implements TicketRepositoryInterface
{
    public function __construct(private readonly Ticket $entity)
    {
    }

    public function getTicketsByCpfPurchaser(Cpf $cpf): \Illuminate\Database\Eloquent\Collection|array
    {
        $query = $this->entity::with(['purchaser']);

        $query->whereHas('purchaser', function ($query) use ($cpf) {
            $query->where('cpf', '=', (string)$cpf);
        });

        return $query->get();
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
