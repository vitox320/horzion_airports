<?php

namespace App\Repositories\Eloquent;

use App\Helpers\DateGenerator;
use App\Models\Ticket;
use App\Repositories\Interface\TicketRepositoryInterface;
use App\ValueObjects\Cpf;

class TicketRepository implements TicketRepositoryInterface
{
    public function __construct(
        private readonly Ticket        $entity,
        private readonly DateGenerator $dateGenerator
    )
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

    public function getTicketByCpfPassenger(Cpf $cpf)
    {
        $query = $this->entity::with(['passenger', 'seat.flightClass.flight']);

        $query->whereHas('passenger', function ($query) use ($cpf) {
            $query->where('cpf', '=', (string)$cpf);
        });

        $ticket = $query->latest()->first();
        $flight = $ticket->seat?->flightClass?->flight;

        $departureDate = \DateTime::createFromFormat('Y-m-d H:i:s', $flight->departure_date);
        $currentDate = \DateTime::createFromFormat('Y-m-d H:i:s', now()->format('Y-m-d H:i:s'));

        if ($this->dateGenerator->getHoursDiff($departureDate, $currentDate) < 5) {
            throw new \DomainException('O limite de tempo para emissão tanto da etiqueta quanto do voucher é de no máximo 5 horas antes do voo.');
        }

        return $ticket;

    }
}
