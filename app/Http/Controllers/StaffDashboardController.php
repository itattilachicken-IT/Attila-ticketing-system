<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    /**
     * Dashboard overview
     */
    public function index()
    {
        return view('staff.dashboard', $this->getTicketStats());
    }

    /**
     * View all tickets (paginated)
     */
    public function allTickets()
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('staff.tickets.all', compact('tickets'));
    }

    /**
     * View a single ticket
     */
    public function show(Ticket $ticket)
    {
        $staffUsers = User::where('role', 'staff')->get();

        $ticket->load([
            'user',
            'assignedStaff',
            'notes.user',
        ]);

        return view('staff.tickets.show', compact('ticket', 'staffUsers'));
    }

    /**
     * View tickets raised by me AND assigned to me
     */
    public function myTickets()
    {
        $userId = auth()->id();

        // Tickets I raised
        $raisedTickets = Ticket::where('user_id', $userId)->get();

        // Tickets assigned to me
        $assignedTickets = Ticket::where('assigned_to', $userId)->get();

        return view('staff.tickets.my-tickets', compact(
            'raisedTickets',
            'assignedTickets'
        ));
    }

    /**
     * Assign a ticket to a staff member
     */
    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $ticket->update([
            'assigned_to' => $request->assigned_to,
        ]);

        return back()->with('success', 'Ticket assigned successfully.');
    }

    /**
     * Update ticket status
     */
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:pending,open,in_progress,closed',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Ticket status updated successfully.');
    }

    /**
     * Show the "Raise Ticket" form
     */
    public function create()
    {
        return view('staff.tickets.create', $this->getTicketStats());
    }

    /**
     * Store a newly raised ticket
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'priority'    => 'required|in:low,medium,high',
            'help_topic'  => 'required|in:technical,billing,general',
        ]);

        Ticket::create([
            'title'       => $request->title,
            'description' => $request->description,
            'priority'    => $request->priority,
            'help_topic'  => $request->help_topic,
            'user_id'     => auth()->id(),
            'status'      => 'open',
        ]);

        return redirect()
            ->route('staff.dashboard')
            ->with('success', 'Ticket raised successfully!');
    }

    /**
     * Helper method to get ticket statistics for the views
     */
    private function getTicketStats(): array
    {
        return [
            'totalTickets'    => Ticket::count(),
            'pendingTickets'  => Ticket::where('status', 'pending')->count(),
            'assignedTickets' => Ticket::where('assigned_to', auth()->id())->count(),
            'closedTickets'   => Ticket::where('status', 'closed')->count(),
            'resolvedTickets' => Ticket::where('status', 'resolved')->count(),
            'recentTickets'   => Ticket::latest()->limit(5)->get(),
        ];
    }
}
