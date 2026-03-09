<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket; // Make sure you have a Ticket model

class TicketingController extends Controller
{
    // Show the form
    public function create()
    {
        return view('staff.tickets.create');
    }

    // Store the ticket
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'user_id' => auth()->id(), // who raised it
            'status' => 'open',
        ]);

        return redirect()->route('staff.dashboard')->with('success', 'Ticket raised successfully!');
    }
}
