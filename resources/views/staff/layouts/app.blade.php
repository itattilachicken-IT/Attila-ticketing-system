<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Staff Dashboard')</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">

    <!-- Top Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-[#fe0000]">
                ICT Support
            </h1>

            <div class="flex items-center gap-4">
                <!-- Raise Ticket Button -->
                <a href="{{ route('staff.tickets.create') }}"
                   class="bg-[#fe0000] text-white px-4 py-2 rounded-lg text-sm hover:bg-[#ffc600] hover:text-black transition">
                    + Raise Ticket
                </a>

                <span class="text-[#000000] text-sm">
                    {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-[#fe0000] hover:text-[#ffc600] hover:underline text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Layout -->
    <div class="flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-white min-h-screen shadow-md hidden md:block">
            <nav class="p-6 space-y-3">

                <a href="{{ route('staff.dashboard') }}"
                   class="block px-4 py-2 rounded-lg text-[#000000] hover:bg-[#ffc600]/20 hover:text-[#fe0000] {{ request()->routeIs('staff.dashboard') ? 'bg-[#fe0000]/10 font-semibold' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('staff.tickets.all') }}"
                   class="block px-4 py-2 rounded-lg text-[#000000] hover:bg-[#ffc600]/20 hover:text-[#fe0000] {{ request()->routeIs('staff.tickets.all') ? 'bg-[#fe0000]/10 font-semibold' : '' }}">
                    All Tickets
                </a>

                {{-- Removed Assigned route to prevent error --}}
                {{-- <a href="{{ route('staff.tickets.assigned') }}"
                   class="block px-4 py-2 rounded-lg text-[#000000] hover:bg-[#ffc600]/20 hover:text-[#fe0000] {{ request()->routeIs('staff.tickets.assigned') ? 'bg-[#fe0000]/10 font-semibold' : '' }}">
                    Assigned to Me
                </a> --}}

                {{-- Replace Pending Tickets link with my tickets --}}
                <a href="{{ route('staff.tickets.my') }}"
                   class="block px-4 py-2 rounded-lg text-[#000000] hover:bg-[#ffc600]/20 hover:text-[#fe0000] {{ request()->routeIs('staff.tickets.my') ? 'bg-[#fe0000]/10 font-semibold' : '' }}">
                    My Tickets
                </a>

                <a href="{{ route('guest.profile') }}"
                   class="block px-4 py-2 rounded-lg text-[#000000] hover:bg-[#ffc600]/20 hover:text-[#fe0000]">
                    Profile
                </a>

            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

</body>
</html>
