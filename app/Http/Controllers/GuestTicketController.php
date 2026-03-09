<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestTicketController extends Controller
{
    /**
     * Show guest tickets (if logged in)
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'You must be logged in to view your tickets.');
        }

        $tickets = Ticket::where('user_id', auth()->id())->get();

        return view('guests.mytickets', compact('tickets'));
    }

    /**
     * Store guest ticket submission
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:20',
            'guest_location' => 'nullable|string|max:255',
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'priority'       => 'required|in:low,medium,high',
            'help_topic'     => 'required|in:technical,billing,general',
        ]);

        $ticket = Ticket::create([
            'guest_name'     => $request->name,
            'guest_email'    => $request->email,
            'guest_phone'    => $request->phone,
            'guest_location' => $request->guest_location,
            'title'          => $request->title,
            'description'    => $request->description,
            'priority'       => $request->priority,
            'help_topic'     => $request->help_topic,
            'user_id'        => auth()->check() ? auth()->id() : null,
            'status'         => 'open',
        ]);

        return redirect()->back()->with([
            'success'      => 'Your support ticket has been submitted successfully.',
            'ticket_id'    => $ticket->id,
            'ticket_email' => $ticket->guest_email,
        ]);
    }

    /**
     * Show the form to check ticket status
     */
    public function statusForm()
    {
        return view('guests.ticket-status');
    }

    /**
     * Process the ticket status check
     */
    public function checkStatus(Request $request)
    {
        $request->validate([
            'ticket_number' => 'nullable|integer',
            'email'         => 'required|email',
        ]);

        $query = Ticket::where('guest_email', $request->email);

        if ($request->ticket_number) {
            $query->where('id', $request->ticket_number);
        }

        $ticket = $query->first();

        if (!$ticket) {
            return back()->with('error', 'Ticket not found.');
        }

        return view('guests.ticket-result', compact('ticket'));
    }

    /**
     * Handle replies from guests, staff, or admin
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $ticket = Ticket::findOrFail($id);

        // Determine who is replying
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role === 'staff') {
                $senderType = 'staff';
            } elseif ($user->role === 'admin') {
                $senderType = 'admin';
            } else {
                $senderType = 'guest';
            }
            $senderId = $user->id;
        } else {
            $senderType = 'guest';
            $senderId = null;
        }

        TicketMessage::create([
            'ticket_id'   => $ticket->id,
            'sender_id'   => $senderId,
            'sender_type' => $senderType,
            'message'     => $request->message,
        ]);

        return back()->with('success', 'Reply sent successfully.');
    }
}