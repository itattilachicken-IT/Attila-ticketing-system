@extends('staff.layouts.app')

@section('title', 'My Tickets')

@section('content')
<div class="max-w-5xl mx-auto p-6">

<h1 class="text-2xl font-bold mb-6 text-black">My Tickets</h1>

{{-- Tickets I Raised --}}
<h2 class="text-lg font-semibold mb-3 text-red-600">🎫 Tickets I Raised</h2>

@forelse ($raisedTickets as $ticket)
<div class="bg-black text-yellow-400 border border-yellow-400 p-4 mb-3 rounded-lg shadow">

<div class="mb-2">
<p class="font-bold text-xl">{{ $ticket->title }}</p>

<p class="text-sm text-yellow-200 mb-1">
Status: <span class="font-semibold">{{ ucfirst($ticket->status) }}</span>
</p>

@if($ticket->assignedUser)
<p class="text-sm text-yellow-200 mb-1">
Assigned to: {{ $ticket->assignedUser->name }}
</p>
@endif

<p class="text-sm text-yellow-100">{{ $ticket->description }}</p>
</div>


{{-- Conversation --}}
<div class="bg-gray-900 p-3 rounded mb-3">

<p class="font-semibold mb-2 text-yellow-400">Conversation</p>

@foreach($ticket->messages as $message)

<div class="mb-2 @if($message->sender_type == 'staff') text-right @endif">

<span class="text-xs text-gray-400">
{{ ucfirst($message->sender_type) }}
</span>

<div class="inline-block px-3 py-2 rounded
@if($message->sender_type == 'staff')
bg-yellow-400 text-black
@elseif($message->sender_type == 'admin')
bg-red-600 text-white
@else
bg-gray-200 text-black
@endif
">

{{ $message->message }}

</div>

</div>

@endforeach


{{-- Reply --}}
<form method="POST" action="{{ route('guest.ticket.reply', $ticket->id) }}">
@csrf

<textarea name="message"
class="w-full p-2 rounded bg-black border border-yellow-400 text-yellow-400 mb-2"
rows="2"
placeholder="Reply to this ticket..."></textarea>

<button class="bg-red-600 text-white px-4 py-1 rounded hover:bg-yellow-400 hover:text-black">
Send
</button>

</form>

</div>


<div class="flex gap-2">

@if($ticket->status != 'closed')
<form action="{{ route('staff.tickets.updateStatus', $ticket->id) }}" method="POST">
@csrf
@method('PATCH')

<input type="hidden" name="status" value="closed">

<button type="submit"
class="bg-red-600 text-white px-4 py-1 rounded hover:bg-yellow-400 hover:text-black transition">
Close Ticket
</button>

</form>
@endif


<form action="{{ route('staff.tickets.destroy', $ticket->id) }}" method="POST"
onsubmit="return confirm('Are you sure you want to delete this ticket?');">

@csrf
@method('DELETE')

<button type="submit"
class="bg-gray-700 text-white px-4 py-1 rounded hover:bg-red-600 transition">
Delete
</button>

</form>

</div>

</div>

@empty
<p class="text-gray-500 mb-6">You haven’t raised any tickets.</p>
@endforelse



{{-- Tickets Assigned to Me --}}
<h2 class="text-lg font-semibold mt-8 mb-3 text-red-600">🧑‍🔧 Tickets Assigned To Me</h2>

@forelse ($assignedTickets as $ticket)

<div class="bg-black text-yellow-400 border border-yellow-400 p-4 mb-3 rounded-lg shadow">

<p class="font-bold text-xl mb-1">{{ $ticket->title }}</p>

<p class="text-sm text-yellow-200 mb-2">
{{ $ticket->description }}
</p>

<p class="text-sm text-yellow-200 mb-2">
Current Status: <span class="font-semibold">{{ ucfirst($ticket->status) }}</span>
</p>


{{-- Conversation --}}
<div class="bg-gray-900 p-3 rounded mb-3">

<p class="font-semibold mb-2 text-yellow-400">Conversation</p>

@foreach($ticket->messages as $message)

<div class="mb-2 @if($message->sender_type == 'staff') text-right @endif">

<span class="text-xs text-gray-400">
{{ ucfirst($message->sender_type) }}
</span>

<div class="inline-block px-3 py-2 rounded
@if($message->sender_type == 'staff')
bg-yellow-400 text-black
@elseif($message->sender_type == 'admin')
bg-red-600 text-white
@else
bg-gray-200 text-black
@endif
">

{{ $message->message }}

</div>

</div>

@endforeach


<form method="POST" action="{{ route('guest.ticket.reply', $ticket->id) }}" class="mt-3">
@csrf

<textarea name="message"
class="w-full p-2 rounded bg-black border border-yellow-400 text-yellow-400 mb-2"
rows="2"
placeholder="Reply to this ticket..."></textarea>

<button class="bg-red-600 text-white px-4 py-1 rounded hover:bg-yellow-400 hover:text-black">
Send
</button>

</form>

</div>


{{-- Status Update --}}
<form action="{{ route('staff.tickets.updateStatus', $ticket->id) }}" method="POST" class="flex gap-2">

@csrf
@method('PATCH')

<select name="status"
class="p-2 rounded border border-yellow-400 bg-black text-yellow-400 focus:ring focus:ring-red-600">

<option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
<option value="approved" {{ $ticket->status == 'approved' ? 'selected' : '' }}>Approved</option>
<option value="rejected" {{ $ticket->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
<option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>

</select>

<button type="submit"
class="bg-red-600 text-white px-4 py-1 rounded hover:bg-yellow-400 hover:text-black transition">
Update
</button>

</form>

</div>

@empty
<p class="text-gray-500">No tickets assigned to you.</p>
@endforelse

</div>
@endsection