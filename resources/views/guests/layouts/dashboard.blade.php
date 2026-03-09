<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Guest Dashboard')</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">

    <!-- Top Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-700">
                 ICT Supportsss
            </h1>

            <div class="flex items-center gap-4">
                <span class="text-gray-600 text-sm">
                    {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-600 hover:underline text-sm">
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

                <a href=""
                   class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-700">
                    Dashboard
                </a>

                <a href="{{route('guests.ticket')}}"
                   class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-700">
                    Open Ticket
                </a>

                <a href="{{route('guest.mytickets')}}"
                   class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-700">
                    My Tickets
                </a>

                <a href=""
                   class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-700">
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
