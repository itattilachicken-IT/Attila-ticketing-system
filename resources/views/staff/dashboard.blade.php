@extends('staff.layouts.app')

@section('title', 'Staff Dashboard')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-black">
    Welcome back 
</h2>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">

    {{-- Total Tickets --}}
    <div class="bg-black text-yellow-400 p-5 rounded-lg shadow-lg">
        <p class="text-sm uppercase tracking-wide text-yellow-300">
            Total Tickets
        </p>
        <p class="text-3xl font-extrabold">
            {{ $totalTickets }}
        </p>
    </div>

    {{-- Pending --}}
    <div class="bg-yellow-500 p-5 rounded-lg shadow-lg">
        <p class="text-sm uppercase tracking-wide text-black">
            Pending
        </p>
        <p class="text-3xl font-extrabold text-black">
            {{ $pendingTickets }}
        </p>
    </div>

    {{-- Assigned to You --}}
    <div class="bg-red-600 p-5 rounded-lg shadow-lg">
        <p class="text-sm uppercase tracking-wide text-red-100">
            Assigned to You
        </p>
        <p class="text-3xl font-extrabold text-white">
            {{ $assignedTickets }}
        </p>
    </div>

    {{-- Resolved --}}
    <div class="bg-gray-900 p-5 rounded-lg shadow-lg">
        <p class="text-sm uppercase tracking-wide text-gray-400">
            Resolved
        </p>
        <p class="text-3xl font-extrabold text-green-400">
            {{ $resolvedTickets }}
        </p>
    </div>

</div>

{{-- Action Buttons --}}
<div class="flex flex-wrap gap-4">

    {{-- My Tickets --}}
    <a href="{{ route('staff.tickets.my') }}"
       class="bg-red-600 text-white px-6 py-3 rounded-md font-semibold
              hover:bg-red-700 transition shadow">
        My Tickets
    </a>

    {{-- Raise Ticket --}}
    <a href="{{ route('staff.tickets.create') }}"
       class="bg-black text-yellow-400 px-6 py-3 rounded-md font-semibold
              hover:bg-yellow-400 hover:text-black transition shadow">
        Raise Ticket
    </a>

</div>
@endsection
