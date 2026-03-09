@extends('guests.layouts.dashboard')

@section('title', 'View Ticket')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">
            Ticket #{{ $ticket->id }}
        </h1>

        <span>
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
        </span>
    </div>

    <!-- Ticket Details -->
    <div class="bg-white rounded-2xl shadow p-6 space-y-4">
        <div>
            <h3 class="text-sm font-semibold text-gray-500">Help Topic</h3>
            <p class="text-gray-800 capitalize">
                {{ $ticket->help_topic }}
            </p>
        </div>

        <div>
            <h3 class="text-sm font-semibold text-gray-500">Description</h3>
            <p class="text-gray-800 leading-relaxed">
                {{ $ticket->description }}
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="font-semibold text-gray-500">Created:</span>
                {{ $ticket->created_at->format('d M Y, H:i') }}
            </div>

            <div>
                <span class="font-semibold text-gray-500">Assigned To:</span>
                {{ $ticket->assignee->name ?? 'Not assigned' }}
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div>
        <a href="{{route('guest.mytickets')}}"
           class="inline-block text-blue-600 hover:underline text-sm">
            ← Back to My Tickets
        </a>
    </div>

</div>

@endsection
