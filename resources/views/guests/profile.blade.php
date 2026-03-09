@extends('guests.layouts.dashboard')

@section('title', 'My Profile')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">

    <!-- Page Header -->
    <h1 class="text-2xl font-bold text-gray-800">My Profile</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Profile Form -->
    <div class="bg-white rounded-2xl shadow p-6">
        <form method="POST" action="{{ route('guest.profile.update') }}" class="space-y-5">
            @csrf

            <!-- Full Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Full Name
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', auth()->user()->name) }}"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500
                    @error('name') border-red-500 @enderror"
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email (read-only) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email Address
                </label>
                <input
                    type="email"
                    value="{{ auth()->user()->email }}"
                    disabled
                    class="w-full border rounded-lg p-2 bg-gray-100 text-gray-600"
                >
                <p class="text-xs text-gray-500 mt-1">
                    Email cannot be changed.
                </p>
            </div>

            <!-- Phone Number -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Phone Number
                </label>
                <input
                    type="text"
                    name="phonenumber"
                    value="{{ old('phonenumber', auth()->user()->phonenumber) }}"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500
                    @error('phonenumber') border-red-500 @enderror"
                >
                @error('phonenumber')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Save Button -->
            <div class="text-right">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                    Save Changes
                </button>
            </div>

        </form>
    </div>

    <!-- Change Password -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Change Password</h2>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Current Password
                </label>
                <input type="password" name="current_password"
                       class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    New Password
                </label>
                <input type="password" name="password"
                       class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Confirm New Password
                </label>
                <input type="password" name="password_confirmation"
                       class="w-full border rounded-lg p-2">
            </div>

            <button class="bg-gray-800 hover:bg-black text-white px-5 py-2 rounded-lg">
                Update Password
            </button>
        </form>
    </div>

</div>

@endsection
