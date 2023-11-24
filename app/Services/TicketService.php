<?php

namespace App\Services;

use App\Helpers\NumberGenerator;
use App\Repositories\Interface\PassengerRepositoryInterface;
use App\Repositories\Interface\SeatRepositoryInterface;
use App\Repositories\Interface\TicketRepositoryInterface;
use App\ValueObjects\Cpf;
use App\ValueObjects\Email;
use Illuminate\Support\Facades\DB;

class TicketService
{
    public function __construct(
        private readonly TicketRepositoryInterface    $repository,
        private readonly PassengerRepositoryInterface $passengerRepository,
        private readonly SeatRepositoryInterface      $seatRepository
    )
    {
    }

    public function store(array $data): void
    {
        DB::transaction(function () use ($data) {
            $data['purchaser']['cpf'] = (string)new Cpf($data['purchaser']['cpf']);
            $data['purchaser']['email'] = (string)new Email($data['purchaser']['email']);
            $purchaser = $this->passengerRepository->store($data['purchaser']);
            $data['passenger_id'] = $purchaser->id;
            $data['purchaser_id'] = $purchaser->id;
            $data['ticket_number'] = NumberGenerator::generatorRandomDigit();
            $data['price'] = $this->createPrice($data['seat_id'], $data['has_baggage_exceeded']);
            $this->repository->store($data);
            if (isset($data['passengers'])) {
                $this->saveManyTickets($data['passengers'], $data['purchaser_id']);
            }
        });

    }

    public function createPrice(int $seat_id, bool $baggage_exceeded)
    {
        $seat = $this->seatRepository->findById($seat_id);
        if ($baggage_exceeded) {
            return $seat->price + ($seat->price * (10 / 100));
        }
        return $seat->price;
    }

    public function saveManyTickets(array $passengers, int $purchaser_id): void
    {
        foreach ($passengers as &$passenger) {
            $passenger['cpf'] = (string)new Cpf($passenger['cpf']);
            $passenger['email'] = (string)new Email($passenger['email']);
            $passengerCreated = $this->passengerRepository->store($passenger);
            $ticket = [];
            $ticket['passenger_id'] = $passengerCreated->id;
            $ticket['purchaser_id'] = $purchaser_id;
            $ticket['ticket_number'] = NumberGenerator::generatorRandomDigit();
            $ticket['seat_id'] = $passenger['seat_id'];
            $ticket['price'] = $this->createPrice($passenger['seat_id'], $passenger['has_baggage_exceeded']);
            $ticket['has_baggage_exceeded'] = $passenger['has_baggage_exceeded'];
            $this->repository->store($ticket);
        }
    }

    public function delete(int $id)
    {
        $ticket = $this->repository->findById($id);
        $this->repository->delete($ticket);
    }


}
