@extends('staff.layouts.app')

@section('title', 'Raise Ticket')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6 text-black">
        Raise a New Ticket
    </h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-4 rounded mb-6 shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-4 rounded mb-6 shadow">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('staff.tickets.store') }}" method="POST" class="bg-black text-yellow-400 p-6 rounded-lg shadow space-y-4">
        @csrf

        {{-- Ticket Title --}}
        <div>
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" 
                   class="w-full border border-yellow-400 rounded p-2 bg-black text-yellow-400 focus:ring focus:ring-red-600" required>
        </div>

        {{-- Ticket Description --}}
        <div>
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" rows="5" 
                      class="w-full border border-yellow-400 rounded p-2 bg-black text-yellow-400 focus:ring focus:ring-red-600" required>{{ old('description') }}</textarea>
        </div>

        {{-- Priority --}}
        <div>
            <label class="block font-semibold mb-1">Priority</label>
            <select name="priority" class="w-full border border-yellow-400 rounded p-2 bg-black text-yellow-400 focus:ring focus:ring-red-600" required>
                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        {{-- Help Topic --}}
        <div>
            <label class="block font-semibold mb-1">Help Topic</label>
            <select name="help_topic" class="w-full border border-yellow-400 rounded p-2 bg-black text-yellow-400 focus:ring focus:ring-red-600" required>
                <option value="technical" {{ old('help_topic') == 'technical' ? 'selected' : '' }}>Technical</option>
                <option value="billing" {{ old('help_topic') == 'billing' ? 'selected' : '' }}>Billing</option>
                <option value="general" {{ old('help_topic') == 'general' ? 'selected' : '' }}>General</option>
            </select>
        </div>

        {{-- Submit Button --}}
        <div>
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-yellow-400 hover:text-black transition shadow">
                Submit Ticket
            </button>
        </div>

    </form>
</div>
@endsection
