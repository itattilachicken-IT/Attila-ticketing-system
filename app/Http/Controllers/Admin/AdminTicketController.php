<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;

class AdminTicketController extends Controller
{
    // ============================
    // ADMIN FUNCTIONS
    // ============================

    // ADMIN: List all tickets
    public function index()
    {
        $tickets = Ticket::with(['user', 'assignedStaff'])->get();
        $backUrl = route('admin.dashboard');

        return view('admin.tickets.index', compact('tickets', 'backUrl'));
    }

    // ADMIN: Show single ticket
    public function show(Ticket $ticket)
    {
        $staffUsers = User::where('role', 'staff')->get();
        $backUrl = route('admin.tickets.index');

        return view('admin.tickets.show', compact('ticket', 'staffUsers', 'backUrl'));
    }

    // ADMIN: Assign ticket
    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $ticket->assigned_to = $request->assigned_to;
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket assigned successfully.');
    }

    // ============================
    // GUEST FUNCTIONS
    // ============================

    // Show guest ticket form
    public function create()
    {
        return view('guest_ticket');
    }

    // Store guest ticket
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:20',
            'guest_location' => 'nullable|string|max:255',
            'title'          => 'required|string|max:255',
            'description'    => 'required|string|max:1000',
            'priority'       => 'required|in:low,medium,high',
            'help_topic'     => 'required|in:technical,billing,general',
        ]);

        // CREATE ticket and store in variable
        $ticket = Ticket::create([
            'user_id'        => auth()->check() ? auth()->id() : null,
            'guest_name'     => auth()->check() ? null : $validated['name'],
            'guest_email'    => auth()->check() ? null : $validated['email'],
            'guest_phone'    => auth()->check() ? null : $validated['phone'],
            'guest_location' => auth()->check() ? null : $validated['guest_location'],
            'title'          => $validated['title'],
            'description'    => $validated['description'],
            'priority'       => $validated['priority'],
            'help_topic'     => $validated['help_topic'],
            'status'         => 'open',
        ]);

        // IMPORTANT: Return ticket ID + email for popup
        return redirect()->route('tickets.public')->with([
            'success'      => 'Your ticket has been submitted successfully!',
            'ticket_id'    => $ticket->id,
            'ticket_email' => $ticket->guest_email,
        ]);
    }
}