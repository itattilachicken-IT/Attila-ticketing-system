@extends('guests.layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-20 bg-white p-8 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6 text-center">Check Ticket Status</h2>

    <!-- Ticket Not Found Error -->
    @if(session('error'))
        <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('guest.ticket.status.check') }}">
        @csrf

        <!-- Ticket Number (Optional) -->
        <div class="mb-4">
            <label class="block mb-2 font-semibold">Ticket Number (Optional)</label>
            <input type="text" name="ticket_number" class="w-full border p-3 rounded">
        </div>

        <!-- Email (Required) -->
        <div class="mb-6">
            <label class="block mb-2 font-semibold">Email</label>
            <input type="email" name="email" class="w-full border p-3 rounded" required>
        </div>

        <button class="w-full bg-red-600 text-white py-3 rounded hover:bg-yellow-400 hover:text-black transition">
            Check Status
        </button>
    </form>

</div>
@endsection