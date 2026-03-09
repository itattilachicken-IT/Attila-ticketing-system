@extends('admin.layouts.app') <!-- reuse admin layout -->

@section('title','Users Management')

@section('content')
<h2 class="text-2xl font-bold mb-4">Users</h2>

<div class="flex gap-2 mb-4">
    <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Add User
    </a>

    <!-- Button to filter only pending users -->
    <a href="{{ route('admin.users.pending') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
        Pending Approvals
    </a>
</div>

<table class="w-full bg-white rounded shadow overflow-x-auto text-sm">
    <thead class="bg-gray-50">
        <tr>
            <th class="p-3 text-left">#</th>
            <th class="p-3 text-left">Name</th>
            <th class="p-3 text-left">Email</th>
            <th class="p-3 text-left">Role</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr class="border-t hover:bg-gray-50">
            <td class="p-3">{{ $user->id }}</td>
            <td class="p-3">{{ $user->name }}</td>
            <td class="p-3">{{ $user->email }}</td>
            <td class="p-3">{{ ucfirst($user->role) }}</td>
            <td class="p-3">
                @if($user->status === 'pending')
                    <span class="text-yellow-600 font-semibold">Pending</span>
                @elseif($user->status === 'approved')
                    <span class="text-green-600 font-semibold">Approved</span>
                @elseif($user->status === 'rejected')
                    <span class="text-red-600 font-semibold">Rejected</span>
                @else
                    <span class="text-gray-600">N/A</span>
                @endif
            </td>
            <td class="p-3 flex gap-2">
                <!-- Approve/Reject buttons for all pending users (staff or guest) -->
                @if(in_array($user->role, ['staff', 'guest']) && $user->status === 'pending')
                    <form method="POST" action="{{ route('admin.users.approve', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">
                            Approve
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.users.reject', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                            Reject
                        </button>
                    </form>
                @endif

                <!-- Delete button -->
                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center p-4 text-gray-500">No users found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
