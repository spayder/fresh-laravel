<?php

namespace Tests\Feature;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketApiTest extends TestCase
{
    use WithFaker;

    public function test_show_only_open_tickets()
    {
        Ticket::factory()->create();

        $response = $this->get(route('tickets.unprocessed'));

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function test_show_only_closed_tickets()
    {
        Ticket::factory()->create([
            'status' => 1,
        ]);

        $response = $this->get(route('tickets.processed'));

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function test_show_users_tickets()
    {
        $userName = $this->faker->name;
        $userEmail = $this->faker->email;

        $data = [
            'user_name' => $userName,
            'user_email' => $userEmail,
        ];

        Ticket::factory()
            ->count(6)
            ->state(new Sequence(
                        ['status' => 1],
                        ['status' => 0],
                    ))
            ->create($data);

        $response = $this->get(route('users.tickets', $userEmail));

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'user_name' => $userName
        ]);
    }
}
