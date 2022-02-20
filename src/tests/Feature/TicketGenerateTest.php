<?php

namespace Tests\Feature;

use App\Models\Ticket;
use Tests\TestCase;

class TicketGenerateTest extends TestCase
{
    public function test_generate_ticket_command()
    {
        $this->artisan('ticket:generate')
            ->assertExitCode(0);

        $this->assertDatabaseCount(Ticket::class, 1);
    }

    public function test_process_tickets_command()
    {
        Ticket::factory()->count(5)->create();

        $this->assertDatabaseCount(Ticket::class, 5);
    }
}
