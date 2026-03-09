@extends('guests.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#fe0000]">
                Staff Login
            </h1>
            <p class="text-[#000000] text-sm mt-2">
                Access support services as a guest user
            </p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-[#000000] mb-1">
                    Email Address
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#ffc600] focus:outline-none @error('email') border-[#fe0000] @enderror"
                >
                @error('email')
                    <p class="text-[#fe0000] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-[#000000] mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#ffc600] focus:outline-none @error('password') border-[#fe0000] @enderror"
                >
                @error('password')
                    <p class="text-[#fe0000] text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input
                    type="checkbox"
                    name="remember"
                    class="h-4 w-4 text-[#fe0000] border-[#000000] rounded"
                >
                <label class="ml-2 text-sm text-[#000000]">
                    Remember me
                </label>
            </div>

            <!-- Login Button -->
            <button
                type="submit"
                class="w-full bg-[#fe0000] hover:bg-[#ffc600] text-white font-semibold py-2 rounded-lg transition"
            >
                Login
            </button>
        </form>

        <!-- Register Link -->
        <div class="text-center mt-6">
            <p class="text-sm text-[#000000]">
                Not registered?
                <a
                    href="{{ route('guest.register') }}"
                    class="text-[#fe0000] hover:underline font-medium"
                >
                    Click here to register
                </a>
            </p>
        </div>

    </div>
</div>
@endsection
