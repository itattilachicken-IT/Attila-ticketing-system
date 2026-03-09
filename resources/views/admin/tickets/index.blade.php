<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Tickets - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-7xl mx-auto">

    <!-- Header + Back Button -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-black">All Tickets</h2>
        <!-- Use backUrl from controller -->
        <a href="{{ $backUrl }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-yellow-400 hover:text-black transition">
            ← Back
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-black text-yellow-400">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Subject</th>
                    <th class="p-3 text-left">Description</th>
                    <th class="p-3 text-left">Created By</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Priority</th>
                    <th class="p-3 text-left">Assigned To</th>
                    <th class="p-3 text-left">Created</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                <tr class="border-t hover:bg-yellow-50">
                    <td class="p-3">{{ $ticket->id }}</td>
                    <td class="p-3 font-semibold">{{ $ticket->title }}</td>
                    <td class="p-3 text-yellow-900">{{ $ticket->description }}</td>
                    <td class="p-3">{{ $ticket->user->name ?? 'Guest' }}</td>
                    <td class="p-3">
                        @if($ticket->status == 'closed')
                            <span class="text-green-600 font-semibold">{{ ucfirst($ticket->status) }}</span>
                        @elseif($ticket->status == 'approved')
                            <span class="text-blue-600 font-semibold">{{ ucfirst($ticket->status) }}</span>
                        @elseif($ticket->status == 'rejected')
                            <span class="text-red-600 font-semibold">{{ ucfirst($ticket->status) }}</span>
                        @else
                            <span class="text-yellow-600 font-semibold">{{ ucfirst($ticket->status) }}</span>
                        @endif
                    </td>
                    <td class="p-3">{{ ucfirst($ticket->priority) }}</td>
                    <td class="p-3 font-semibold">{{ $ticket->assignedStaff->name ?? 'Unassigned' }}</td>
                    <td class="p-3">{{ $ticket->created_at->format('d M Y') }}</td>
                    <td class="p-3">
                        <a href="{{ route('admin.tickets.show', $ticket) }}" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-yellow-400 hover:text-black transition">
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="p-4 text-center text-gray-500">No tickets found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
