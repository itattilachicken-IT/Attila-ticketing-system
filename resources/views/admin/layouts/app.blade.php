<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-red-600 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('admin.dashboard') }}" class="font-bold">Admin Dashboard</a>
            <div>
                <a href="{{ route('admin.users.index') }}" class="mr-4">Users</a>
                <a href="{{ route('admin.tickets.index') }}">Tickets</a>
            </div>
        </div>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
