@extends('admin.layouts.app')

@section('title','Add User')

@section('content')
<h2 class="text-2xl font-bold mb-4">Add User</h2>

<form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
    @csrf
    <div>
        <label class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Role</label>
        <select name="role" class="w-full border rounded px-3 py-2">
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
            <option value="guest">Guest</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create User</button>
</form>
@endsection
