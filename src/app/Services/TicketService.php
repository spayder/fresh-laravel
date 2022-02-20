<?php

namespace App\Services;

use App\Repositories\TicketRepository;

class TicketService
{
    /**
     * @var TicketRepository
     */
    private $repository;

    public function __construct(TicketRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getProcessed()
    {
        return $this->repository->processed();
    }

    public function getUnprocessed()
    {
        return $this->repository->unprocessed();
    }

    public function generateTicket()
    {
        $this->repository->generate();
    }

    public function processTickets()
    {
        $this->repository->processTickets();
    }

    public function getStats(): array
    {
        $highestRankUser = $this->repository->highestRankUser();
        $tickets =$this->repository->ticketsStats();

        return [
            'total_number_of_tickets' => $tickets->total,
            'total_number_of_unprocessed' => $tickets->unprocessed,
            'total_number_of_processed' => $tickets->processed,
            'name_of_user_with_more_tickets' => $highestRankUser->user_name,
        ];
    }

    public function getTicketsFor($email)
    {
        return $this->repository->ticketsFor($email);
    }
}
