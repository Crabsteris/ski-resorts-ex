<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.ski_resorts') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 antialiased">

<nav class="bg-slate-950 border-b border-slate-800 shadow-sm">
    <div class="max-w-6xl mx-auto px-4">
        <div class="h-16 flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ route('resorts.index') }}"
               class="flex items-center gap-2 font-extrabold text-lg text-white hover:text-indigo-400 transition-colors duration-200 tracking-tight">
                <span class="text-xl">❄️</span>
                <span>{{ __('messages.ski_resorts') }}</span>
            </a>

            {{-- Right side --}}
            <div class="flex items-center gap-4 text-sm font-medium">

                {{-- Public/Auth navigation --}}
                @auth
                    <div class="hidden md:flex items-center gap-5">
                        <a href="{{ route('wishlist.index') }}"
                           class="text-slate-300 hover:text-white transition-colors duration-200">
                            {{ __('messages.wishlist') }}
                        </a>

                        <a href="{{ route('profile') }}"
                           class="text-slate-300 hover:text-white transition-colors duration-200">
                            {{ __('messages.profile') }}
                        </a>

                        <a href="{{ route('dashboard') }}"
                           class="text-slate-300 hover:text-white transition-colors duration-200">
                            {{ __('messages.dashboard') }}
                        </a>

                        @if(auth()->user()->role === 'admin')
                            <div class="h-5 w-px bg-slate-700"></div>

                            <a href="{{ route('admin.resorts.index') }}"
                            class="text-yellow-300 hover:text-yellow-200 transition-colors duration-200">
                                {{ __('messages.admin') }}
                            </a>

                            <a href="{{ route('admin.resorts.trash') }}"
                            class="text-yellow-300 hover:text-yellow-200 transition-colors duration-200">
                                {{ __('messages.trash') }}
                            </a>

                            <a href="{{ route('admin.logs') }}"
                            class="text-yellow-300 hover:text-yellow-200 transition-colors duration-200">
                                {{ __('messages.logs') }}
                            </a>
                        @endif
                    </div>

                    {{-- Language switcher --}}
                    <div class="flex items-center rounded-lg bg-slate-900 border border-slate-800 overflow-hidden">
                        <a href="{{ route('language.switch', 'lv') }}"
                           class="px-2.5 py-1.5 text-xs text-slate-300 hover:bg-slate-800 hover:text-white transition-colors duration-200">
                            LV
                        </a>

                        <a href="{{ route('language.switch', 'en') }}"
                           class="px-2.5 py-1.5 text-xs text-slate-300 hover:bg-slate-800 hover:text-white transition-colors duration-200 border-l border-slate-800">
                            EN
                        </a>
                    </div>

                    {{-- User + logout --}}
                    <div class="hidden sm:flex items-center gap-3 pl-2 border-l border-slate-800">
                        <span class="text-slate-400 max-w-32 truncate">
                            {{ Auth::user()->name }}
                        </span>

                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit"
                                    class="bg-slate-800 hover:bg-red-600 text-slate-300 hover:text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200">
                                {{ __('messages.logout') }}
                            </button>
                        </form>
                    </div>

                @else
                    {{-- Language switcher --}}
                    <div class="flex items-center rounded-lg bg-slate-900 border border-slate-800 overflow-hidden">
                        <a href="{{ route('language.switch', 'lv') }}"
                           class="px-2.5 py-1.5 text-xs text-slate-300 hover:bg-slate-800 hover:text-white transition-colors duration-200">
                            LV
                        </a>

                        <a href="{{ route('language.switch', 'en') }}"
                           class="px-2.5 py-1.5 text-xs text-slate-300 hover:bg-slate-800 hover:text-white transition-colors duration-200 border-l border-slate-800">
                            EN
                        </a>
                    </div>

                    <a href="{{ route('login') }}"
                       class="text-slate-300 hover:text-white transition-colors duration-200">
                        {{ __('messages.login') }}
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition-colors duration-200 shadow-sm text-sm font-semibold">
                        {{ __('messages.register') }}
                    </a>
                @endauth

            </div>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

</body>
</html>