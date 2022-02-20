<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function tickets(TicketService $service, Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            $service->getTicketsFor($request->email)
        );
    }
}
