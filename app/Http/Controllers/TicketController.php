<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function index()
    {
        $tickets = Ticket::with(['ticket_type','user'])->paginate(env('PAGINATE_COUNT'));
        return view('admin.tickets.tickets')->with(
            ['tickets' => $tickets]
        );
    }
}
