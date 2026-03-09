<!DOCTYPE html>
<html lang="en"
      x-data="{
          showModal: false,
          loading: true
      }"
      x-init="
          @if(session('ticket_id') && session('ticket_email'))
              showModal = true;
              setTimeout(() => loading = false, 1500);
          @endif
      "
>
<head>
    <meta charset="UTF-8">
    <title>Raise a Ticket - Guest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6">

<div class="max-w-3xl mx-auto">

    <!--  BACK BUTTON -->
  <div class="mb-8">
    <a href="{{ url()->previous() }}"
       class="group inline-flex items-center gap-2 px-5 py-2.5 
              bg-gradient-to-r from-red-600 to-red-800
              text-white rounded-xl
              shadow-lg hover:shadow-2xl
              transition-all duration-300
              hover:-translate-y-1 active:translate-y-0 active:shadow-md">

        <span class="text-lg transition-transform duration-300 group-hover:-translate-x-1">
            ←
        </span>

        <span class="text-sm font-semibold">
            Back
        </span>
    </a>
</div>

    <!-- ================= HEADER ================= -->
    <div class="mb-10 px-6 sm:px-10 py-10 bg-[#ffc600] rounded-xl shadow-md text-center sm:text-left">
        <h1 class="text-2xl sm:text-3xl font-semibold text-black">
            Raise a New 
            <span class="text-[#fe0000]">Support</span> Ticket
        </h1>

        <p class="text-black mt-4 text-sm sm:text-base tracking-wide">
            Kindly complete the form below. Our support team will review and respond promptly.
        </p>
    </div>

    <!-- ================= SUCCESS MESSAGE ================= -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded mb-8">
            {{ session('success') }}
        </div>
    @endif

    <!-- ================= VALIDATION ERRORS ================= -->
    @if ($errors->any())
        <div class="bg-red-50 border border-red-400 text-red-600 p-4 rounded mb-8">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- ================= FORM ================= -->
    <form action="{{ route('guest.tickets.store') }}" method="POST"
          class="bg-white p-6 sm:p-10 rounded-xl shadow-lg border border-gray-200 space-y-8">
        @csrf

        <!-- ===== PERSONAL INFORMATION ===== -->
        <div>
            <h2 class="text-lg font-semibold text-black mb-6 border-b pb-2">
                Personal Information
            </h2>

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium mb-2">Full Name</label>
                    <input type="text" name="name"
                           class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Email Address</label>
                    <input type="email" name="email"
                           class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Phone Number</label>
                    <input type="text" name="phone"
                           class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Location</label>
                    <input type="text" name="guest_location"
                           class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">
                </div>

            </div>
        </div>

        <!-- ===== TICKET DETAILS ===== -->
        <div>
            <h2 class="text-lg font-semibold text-black mb-6 border-b pb-2">
                Ticket Details
            </h2>

            <div class="space-y-6">

                <div>
                    <label class="block text-sm font-medium mb-2">Subject</label>
                    <input type="text" name="title"
                           class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Description</label>
                    <textarea name="description" rows="6"
                              class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                              required></textarea>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium mb-2">Priority</label>
                        <select name="priority"
                                class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                                required>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Help Topic</label>
                        <select name="help_topic"
                                class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                                required>
                            <option value="technical">Technical</option>
                            <option value="billing">Billing</option>
                            <option value="general">General</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <!-- ===== SUBMIT ===== -->
        <div class="pt-8 border-t text-center sm:text-right">
            <button type="submit"
                class="w-full sm:w-auto bg-[#fe0000] text-white px-10 py-3 rounded-lg font-medium hover:opacity-90 transition">
                Submit Ticket
            </button>
        </div>

    </form>

    <!-- ===== FOOTER ===== -->
    <div class="mt-14 text-center text-xs text-gray-500 tracking-wide">
        <div class="h-1 w-20 mx-auto bg-[#ffc600] mb-4"></div>
        © 2026 Support Services Department. All rights reserved.
    </div>

</div>


<!-- ================= MODAL ================= -->
@if(session('ticket_id') && session('ticket_email'))

<div x-show="showModal"
     x-cloak
     class="fixed inset-0 flex items-center justify-center bg-black/60 backdrop-blur-sm z-50 px-4 overflow-y-auto">

    <!-- Loading -->
    <div x-show="loading"
         class="flex flex-col items-center bg-white p-8 rounded-xl shadow-lg max-w-sm w-full">
        <svg class="animate-spin h-10 w-10 text-red-600 mb-4"
             xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10"
                    stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75"
                  fill="currentColor"
                  d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        <p class="font-medium">Submitting your ticket...</p>
    </div>

    <!-- Success -->
    <div 
    x-show="!loading"
    x-transition
    class="relative bg-white/95 backdrop-blur-xl 
           rounded-2xl p-6 sm:p-10 max-w-lg w-full text-center 
           shadow-2xl border border-white/20">

        <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-black 
                    rounded-2xl blur-xl opacity-20 -z-10"></div>

        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-6 tracking-wide">
            Ticket Submitted Successfully
        </h2>

        <div class="space-y-3 text-base sm:text-lg">
            <p>
                <span class="font-semibold text-gray-700">Ticket ID:</span>
                <span class="text-red-600 font-bold tracking-wider">
                    {{ session('ticket_id') }}
                </span>
            </p>

            <p>
                <span class="font-semibold text-gray-700">Email:</span>
                <span class="text-gray-800">
                    {{ session('ticket_email') }}
                </span>
            </p>
        </div>

        <button 
            @click="showModal = false"
            class="mt-8 w-full sm:w-auto px-8 py-3 text-lg font-semibold text-white 
                   bg-gradient-to-r from-red-600 to-red-800 
                   rounded-xl shadow-lg 
                   hover:shadow-2xl hover:scale-105 
                   active:scale-95 
                   transition-all duration-300 
                   focus:outline-none focus:ring-4 focus:ring-red-300">
            Close
        </button>

    </div>

</div>

@endif

</body>
</html>