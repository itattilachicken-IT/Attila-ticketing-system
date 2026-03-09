<!DOCTYPE html>
<html lang="en" x-data>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#fff8f0] min-h-screen font-sans">

    <!-- Navbar -->
    <nav class="bg-[#fe0000] p-4 text-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="font-bold text-xl">ATTILA ICT Admin</a>
            <div class="flex items-center">
                <a href="{{ route('admin.users.index') }}" class="mr-4 hover:text-[#ffc600]">Users</a>
                <a href="{{ route('admin.tickets.index') }}" class="mr-4 hover:text-[#ffc600]">Tickets</a>
                
                <!-- Dropdown example with Alpine -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="hover:text-[#ffc600]">Account ▾</button>
                    <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-white text-black rounded shadow-lg py-2 z-10">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="block px-4 py-2 hover:bg-[#ffc600] hover:text-[#fe0000] transition">Logout</a>
                    </div>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto mt-8 px-4">
        <h1 class="text-4xl font-bold text-[#fe0000] mb-8">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Users Card -->
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="text-2xl font-semibold text-[#fe0000] mb-2">Users</h2>
                <p class="text-gray-700 mb-4">Manage all system users</p>
                <a href="{{ route('admin.users.index') }}" class="inline-block px-4 py-2 bg-[#ffc600] text-[#fe0000] font-semibold rounded hover:bg-[#fe0000] hover:text-white transition">
                    Go
                </a>
            </div>

            <!-- Tickets Card -->
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="text-2xl font-semibold text-[#fe0000] mb-2">Tickets</h2>
                <p class="text-gray-700 mb-4">View and assign tickets</p>
                <a href="{{ route('admin.tickets.index') }}" class="inline-block px-4 py-2 bg-[#ffc600] text-[#fe0000] font-semibold rounded hover:bg-[#fe0000] hover:text-white transition">
                    Go
                </a>
            </div>

            <!-- Reports Card -->
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="text-2xl font-semibold text-[#fe0000] mb-2">Reports</h2>
                <p class="text-gray-700 mb-4">See system reports (future)</p>
                <span class="inline-block px-4 py-2 bg-[#ffc600] text-[#fe0000] font-semibold rounded cursor-not-allowed opacity-50">
                    Coming Soon
                </span>
            </div>
        </div>
    </main>

</body>
</html>
