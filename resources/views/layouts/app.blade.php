<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ski Resorts</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 antialiased"> 

<nav class="bg-slate-900 border-b border-slate-800 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">

        <a href="{{ route('resorts.index') }}"
           class="font-extrabold text-xl text-white hover:text-indigo-400 transition-colors duration-200 tracking-tight">
            ❄️ Ski Resorts
        </a>

        {{-- Navigācijas saites --}}
        <div class="flex items-center space-x-6 text-sm font-medium">

            @auth
                <span class="text-slate-400 border-r border-slate-700 pr-4">
                    Sveiks, <strong class="text-white font-semibold">{{ Auth::user()->name }}</strong>
                </span>

                <a href="{{ route('wishlist.index') }}" class="text-slate-300 hover:text-indigo-400 transition-colors duration-200">
                    Wishlist
                </a>

                <a href="{{ route('profile') }}" class="text-slate-300 hover:text-indigo-400 transition-colors duration-200">
                    Profile
                </a>

                <a href="{{ route('dashboard') }}" class="text-slate-300 hover:text-indigo-400 transition-colors duration-200">
                    Dashboard
                </a>

                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.resorts.index') }}" class="text-slate-300 hover:text-yellow-400 transition-colors duration-200">
                    Admin
                </a>
                <a href="{{ route('admin.logs') }}" class="text-slate-300 hover:text-yellow-400 transition-colors duration-200">
                    Logs
                </a>
                @endif
                
                <form action="{{ route('logout') }}" method="POST" class="inline m-0 p-0">
                    @csrf
                    <button type="submit" 
                            class="bg-slate-800 hover:bg-red-600 text-slate-300 hover:text-white px-3 py-1.5 rounded-lg text-sm font-medium transition-all duration-200 shadow-sm">
                        Log Out
                    </button>
                </form>

            @else
                <a href="{{ route('login') }}" class="text-slate-300 hover:text-indigo-400 transition-colors duration-200">
                    Login
                </a>

                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition-colors duration-200 shadow-sm">
                    Register
                </a>
            @endauth

        </div>
    </div>
</nav>


<main>
    @yield('content')
</main>

</body>
</html>