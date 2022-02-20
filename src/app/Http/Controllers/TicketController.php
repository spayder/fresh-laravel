<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    /**
     * @var TicketService
     */
    protected $service;

    public function __construct(TicketService $service)
    {
        $this->service = $service;
    }

    public function unprocessed(): JsonResponse
    {
        return response()->json(
            $this->service->getUnprocessed()
        );
    }

    public function processed(): JsonResponse
    {
        return response()->json(
            $this->service->getProcessed()
        );
    }

    public function stats(): JsonResponse
    {
        return response()->json(
            $this->service->getStats()
        );
    }
}
