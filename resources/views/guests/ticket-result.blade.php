@extends('guests.layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-20 bg-white p-8 rounded-xl shadow">

<h2 class="text-2xl font-bold mb-6 text-center">Ticket Details</h2>

<p><strong>Ticket ID:</strong> {{ $ticket->id }}</p>
<p><strong>Title:</strong> {{ $ticket->title }}</p>
<p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
<p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>

<p class="mt-4"><strong>Description:</strong></p>
<p class="whitespace-pre-line">{{ $ticket->description }}</p>

<hr class="my-6">

<h3 class="text-xl font-semibold mb-4">Conversation</h3>

@foreach($ticket->messages as $message)

<div class="mb-4 p-3 rounded 
@if($message->sender_type == 'admin') bg-blue-50
@elseif($message->sender_type == 'staff') bg-green-50
@else bg-gray-50
@endif">

<p class="text-sm text-gray-600 mb-1">
{{ ucfirst($message->sender_type) }}
</p>

<p>{{ $message->message }}</p>

<p class="text-xs text-gray-400 mt-1">
{{ $message->created_at->diffForHumans() }}
</p>

</div>

@endforeach


<hr class="my-6">

<h3 class="text-lg font-semibold mb-2">Reply</h3>

<form method="POST" action="{{ route('guest.ticket.reply', $ticket->id) }}">
@csrf

<textarea name="message"
class="w-full border rounded p-2 mb-3"
rows="4"
placeholder="Write your message..."></textarea>

<button type="submit"
class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
Send Reply
</button>

</form>

</div>
@endsection