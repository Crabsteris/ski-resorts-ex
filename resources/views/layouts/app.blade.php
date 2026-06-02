<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ski Resorts</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<nav class="bg-blue-900 text-white">
    <div class="container mx-auto px-4 py-4 flex justify-between">

        <a href="{{ route('resorts.index') }}"
           class="font-bold text-xl">
            Ski Resorts
        </a>

        <div class="space-x-4">

            @auth

                <span>
                    {{ Auth::user()->name }}
                </span>

                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>

            @else

                <a href="{{ route('login') }}">
                    Login
                </a>

                <a href="{{ route('register') }}">
                    Register
                </a>

            @endauth

        </div>
    </div>
</nav>

<main class="container mx-auto px-4 py-8">
    @yield('content')
</main>

</body>
</html>