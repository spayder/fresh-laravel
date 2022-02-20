<?php

namespace App\Console\Commands;

use App\Services\TicketService;
use Illuminate\Console\Command;

class GenerateTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a ticket';

    /**
     * @var TicketService
     */
    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TicketService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Generate ticket started');

        $this->service->generateTicket();

        $this->info('Generate ticket finished');
        return 0;
    }
}
