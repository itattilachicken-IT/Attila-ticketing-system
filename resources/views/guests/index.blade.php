@extends('guests.layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center px-6 bg-gray-50">

    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-extrabold text-black tracking-wide">
            ATTILA <span class="text-[#fe0000]">ICT</span> SUPPORT
        </h1>
        <p class="text-lg text-gray-600 mt-3">
            Fast • Reliable • Professional Support
        </p>
    </div>

    <!-- Main Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl w-full mb-14">

        <!-- Knowledge Base -->
        <div class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition border-t-4 border-[#ffc600]">
            <div class="text-[#ffc600] text-4xl mb-4">
                <i class="ri-book-open-line"></i>
            </div>
            <h3 class="text-xl font-bold text-black mb-3">
                Knowledge Base
            </h3>
            <p class="text-gray-600 mb-5">
                Browse guides, FAQs, and solutions to common ICT issues.
            </p>
            <a href="#" class="text-[#fe0000] font-semibold hover:underline">
                Explore Articles →
            </a>
        </div>

       <!-- Open Ticket -->
<div class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition border-t-4 border-[#fe0000]">
    <div class="text-[#fe0000] text-4xl mb-4">
        <i class="ri-ticket-2-line"></i>
    </div>
    <h3 class="text-xl font-bold text-black mb-3">
        Open a Ticket
    </h3>
    <p class="text-gray-600 mb-5">
        Submit your issue and our support team will assist you quickly.
    </p>
    <!-- Button that opens the Raise Ticket page -->
<!-- Button that opens the Raise Ticket page for Guests -->
<!-- Button that opens the Raise Ticket page for all users -->
<a href="{{ route('guest.tickets.create') }}"
   class="inline-block bg-red-600 text-white px-6 py-2 rounded hover:bg-yellow-400 hover:text-black transition font-semibold">
    Create Ticket → 
</a>


</div>


        <!-- Ticket Status -->
        <div class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition border-t-4 border-black">
            <div class="text-black text-4xl mb-4">
                <i class="ri-time-line"></i>
            </div>
            <h3 class="text-xl font-bold text-black mb-3">
                Track Ticket
            </h3>
            <p class="text-gray-600 mb-5">
                Check the progress and updates of your support tickets.
            </p>
      <a href="{{ route('guest.ticket.status.form') }}" class="text-[#fe0000] font-semibold hover:underline">
    Check Status →
</a>
        </div>
    </div>

    <!-- Authentication -->
    <div class="text-center space-y-6 max-w-xl">

        <p class="text-gray-700 font-medium">
            Access support as a Guest or Staff member
        </p>

       <div class="flex flex-col items-center gap-4">

    <!-- Action buttons -->
    <div class="flex flex-col md:flex-row gap-4 justify-center">
        <a href="{{ route('guest.login') ?? '#' }}"
           class="bg-[#fe0000] text-white px-8 py-3 rounded-lg font-semibold shadow hover:bg-red-700 transition">
            Staff Sign In
        </a>

        <a href="{{ route('guest.register') ?? '#' }}"
           class="border border-[#fe0000] text-[#fe0000] px-8 py-3 rounded-lg font-semibold hover:bg-red-50 transition">
            Create an Account
        </a>
    </div>

    <!-- Supporting text -->
    <p class="text-gray-600 text-center">
        New here? Register to enjoy faster and better support.
    </p>
</div>


</div>
@endsection
