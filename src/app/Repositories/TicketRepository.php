<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class TicketRepository
{
    public function processed()
    {
        return Ticket::processed()->get();
    }

    public function unprocessed()
    {
        return Ticket::unprocessed()->get();
    }

    public function generate()
    {
        Ticket::factory()->create();
    }

    public function processTickets()
    {
        Ticket::unprocessed()
            ->get()
            ->map(function ($ticket) {
                $this->process($ticket);
            });
    }

    private function process(Ticket $ticket)
    {
        $ticket->status = Ticket::PROCESSED;
        $ticket->updated_at = now();
        $ticket->save();
    }

    public function highestRankUser()
    {
        // for that query to work correctly we have to ensure that a name always corresponds to an email
        return Ticket::select('user_email', 'user_name')
            ->groupBy('user_email', 'user_name')
            ->orderBy(DB::raw('count(user_email)'), 'DESC')
            ->first();
    }

    public function ticketsStats()
    {
        return Ticket::select(DB::raw(
            'COUNT(*) total,
                    SUM(status = 0) unprocessed,
                    SUM(status = 1) processed'
        ))->first();
    }

    public function ticketsFor($email)
    {
        return Ticket::where('user_email', $email)
            ->paginate();
    }
}
