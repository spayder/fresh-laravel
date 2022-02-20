<?php

namespace Tests\Feature;

use App\Models\Ticket;
use Tests\TestCase;

class TicketProcessTest extends TestCase
{
    public function test_process_ticket_command()
    {
        Ticket::factory()->create();

        $this->assertDatabaseCount(Ticket::class, 1);
        $this->assertDatabaseHas(Ticket::class, [
            'status' => 0
        ]);

        $this->artisan('ticket:process')
            ->assertExitCode(0);

        $this->assertDatabaseHas(Ticket::class, [
            'status' => 1
        ]);
    }
}
