@extends('staff.layouts.app')

@section('title','Ticket Details - Admin')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-black">
            Ticket 
            <span class="text-red-600">
                {{ 'TCK-' . $ticket->created_at->format('Y') . '-' . str_pad($ticket->id, 4, '0', STR_PAD_LEFT) }}
            </span>
        </h2>

        <a href="{{ url()->previous() }}"
           class="bg-red-600 text-white px-4 py-2 rounded
                  hover:bg-yellow-400 hover:text-black transition">
            ← Back
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Ticket Details -->
        <div class="lg:col-span-2 bg-black text-yellow-400 rounded-lg shadow p-6 space-y-5 border border-yellow-400">

            <div>
                <p class="text-sm text-yellow-300">Title</p>
                <p class="font-bold text-xl">{{ $ticket->title }}</p>
            </div>

            <div>
                <p class="text-sm text-yellow-300">Description</p>
                <p class="text-yellow-100 whitespace-pre-line">
                    {{ $ticket->description }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-yellow-300">Status</p>
                    @php
                        $statusColors = [
                            'pending'  => 'bg-yellow-400 text-black',
                            'approved' => 'bg-green-500 text-black',
                            'rejected' => 'bg-red-600 text-white',
                            'closed'   => 'bg-gray-700 text-white',
                            'open'     => 'bg-yellow-400 text-black',
                        ];
                    @endphp
                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded
                        {{ $statusColors[$ticket->status] ?? 'bg-gray-500 text-white' }}">
                        {{ ucfirst($ticket->status) }}
                    </span>
                </div>

                <div>
                    <p class="text-sm text-yellow-300">Priority</p>
                    <p class="font-semibold">{{ ucfirst($ticket->priority) }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-yellow-300">Created By</p>
                    @if($ticket->user)
                        <p>{{ $ticket->user->name }} (Staff)</p>
                        <p class="text-sm text-yellow-200">{{ $ticket->user->email }}</p>
                    @else
                        <p>{{ $ticket->guest_name ?? 'Guest' }}</p>
                        <p class="text-sm text-yellow-200">{{ $ticket->guest_email ?? '-' }}</p>
                        <p class="text-sm text-yellow-200">{{ $ticket->guest_phone ?? '-' }}</p>
                    @endif
                </div>

                <div>
                    <p class="text-sm text-yellow-300">Created At</p>
                    <p>{{ $ticket->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div>
                <p class="text-sm text-yellow-300">Assigned To</p>
                <p class="font-semibold">
                    {{ $ticket->assignedStaff->name ?? 'Unassigned' }}
                </p>
            </div>

        </div>

        <!-- Admin Actions -->
        <div class="bg-white rounded-lg shadow p-6 space-y-5 border-t-4 border-red-600">

            <h3 class="font-bold text-lg text-black">Admin Actions</h3>

            <!-- Assign Ticket -->
            <form method="POST" action="{{ route('admin.tickets.assign', $ticket) }}">
                @csrf
                @method('PATCH')

                <label class="text-sm font-semibold text-gray-700">
                    Assign to Staff
                </label>

                <select name="assigned_to"
                        class="w-full border rounded p-2 mt-1 focus:ring focus:ring-yellow-400">
                    <option value="">Unassigned</option>

                    @foreach($staffUsers as $staff)
                        <option value="{{ $staff->id }}"
                            {{ $ticket->assigned_to == $staff->id ? 'selected' : '' }}>
                            {{ $staff->name }}
                        </option>
                    @endforeach
                </select>

                <button
                    class="mt-4 w-full bg-red-600 text-white py-2 rounded
                           hover:bg-yellow-400 hover:text-black transition font-semibold">
                    Assign Ticket
                </button>
            </form>

        </div>

    </div>
</div>

@endsection