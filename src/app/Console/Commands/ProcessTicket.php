<?php

namespace App\Console\Commands;

use App\Services\TicketService;
use Illuminate\Console\Command;

class ProcessTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process tickets';

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
        $this->info('Processing tickets started');

        $this->service->processTickets();
        $this->info('Processing tickets finished');
        return 0;
    }
}
