@extends('guests.layouts.dashboard')

@section('title', 'My Tickets')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">My Tickets</h1>

        <a href=""
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
            + Open Ticket
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tickets Table -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Help Topic</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Created</th>
                    <th class="px-6 py-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($tickets as $ticket)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">
                            #{{ $ticket->id }}
                        </td>

                        <td class="px-6 py-4 capitalize">
                            {{ $ticket->help_topic }}
                        </td>

                        <td class="px-6 py-4">
                            @if($ticket->status === 'open')
                                <span class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">
                                    Open
                                </span>
                            @elseif($ticket->status === 'in_progress')
                                <span class="px-3 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">
                                    In Progress
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                                    Closed
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $ticket->created_at->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">
                                <a href="{{ route('guest.tickets.show', $ticket->id) }}"
                                
                               class="text-blue-600 hover:underline text-sm">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            You have not opened any tickets yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
