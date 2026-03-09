@extends('guests.layouts.app')

@section('content')
<div class="min-h-screen bg-[#ffc600]/10 flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border-t-8 border-[#fe0000]">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-[#000000]">Staff Registration</h1>
            <p class="text-sm mt-2 text-gray-600">
                Admin approval is required before you can log in.
            </p>
        </div>

        <form method="POST" action="{{ route('staff.register.submit') }}" class="space-y-5">
            @csrf

            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}"
                class="w-full px-4 py-2 border rounded-lg @error('name') border-[#fe0000] @enderror">
            @error('name') <p class="text-[#fe0000] text-sm mt-1">{{ $message }}</p> @enderror

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                class="w-full px-4 py-2 border rounded-lg @error('email') border-[#fe0000] @enderror">
            @error('email') <p class="text-[#fe0000] text-sm mt-1">{{ $message }}</p> @enderror

            <input type="tel" name="phonenumber" placeholder="Phone Number" value="{{ old('phonenumber') }}"
                class="w-full px-4 py-2 border rounded-lg @error('phonenumber') border-[#fe0000] @enderror">
            @error('phonenumber') <p class="text-[#fe0000] text-sm mt-1">{{ $message }}</p> @enderror

            <input type="password" name="password" placeholder="Password"
                class="w-full px-4 py-2 border rounded-lg @error('password') border-[#fe0000] @enderror">
            @error('password') <p class="text-[#fe0000] text-sm mt-1">{{ $message }}</p> @enderror

            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                class="w-full px-4 py-2 border rounded-lg">

            <button type="submit"
                class="w-full bg-[#fe0000] text-white py-2.5 rounded-lg hover:bg-black transition">
                Register
            </button>
        </form>

        <div class="text-center mt-6">
            <!-- Updated route -->
            <a href="{{ route('login') }}" class="text-[#fe0000] font-semibold hover:text-black">
                Already registered? Login here
            </a>
        </div>
    </div>
</div>

<!-- Pending approval popup -->
@if(session('pending_approval'))
<div class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
    <div class="bg-white rounded-xl p-6 max-w-sm text-center shadow-lg">
        <h2 class="text-xl font-bold text-[#fe0000] mb-2">Registration Successful 🎉</h2>
        <p class="text-gray-700 mb-4">
            Your staff account is pending admin approval. You will be able to log in once approved.
        </p>
        <!-- Updated route -->
        <a href="{{ route('login') }}"
            class="w-full block bg-[#fe0000] text-white py-2 rounded-lg hover:bg-black transition">
            OK
        </a>
    </div>
</div>
@endif
@endsection
