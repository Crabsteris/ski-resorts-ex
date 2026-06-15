@extends('layouts.app')

@section('content')
<div class="bg-slate-100 min-h-screen flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md">

        <div class="bg-white border border-slate-200 shadow-sm">

            <div class="bg-slate-900 px-6 py-5 border-b border-slate-800">
                <a href="{{ route('resorts.index') }}" class="inline-flex items-center gap-2 text-white font-bold text-lg">
                    <span>❄️</span>
                    <span>{{ __('messages.ski_resorts') }}</span>
                </a>

                <h1 class="text-2xl font-extrabold text-white mt-5">
                    {{ __('messages.register') }}
                </h1>

                <p class="text-slate-400 text-sm mt-1">
                    Create an account to save resorts and write reviews.
                </p>
            </div>

            <div class="p-6">

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">
                            Name
                        </label>

                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               autofocus
                               autocomplete="name"
                               class="bg-white border border-slate-300 text-slate-900 p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">

                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">
                            Email
                        </label>

                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autocomplete="username"
                               class="bg-white border border-slate-300 text-slate-900 p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">

                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">
                            Password
                        </label>

                        <input id="password"
                               type="password"
                               name="password"
                               required
                               autocomplete="new-password"
                               class="bg-white border border-slate-300 text-slate-900 p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">

                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1">
                            Confirm Password
                        </label>

                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               required
                               autocomplete="new-password"
                               class="bg-white border border-slate-300 text-slate-900 p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">

                        @error('password_confirmation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 px-4 transition-colors duration-200 text-sm shadow-sm">
                        {{ __('messages.register') }}
                    </button>
                </form>

                <div class="mt-6 pt-5 border-t border-slate-200 text-center text-sm text-slate-500">
                    Already have an account?

                    <a href="{{ route('login') }}"
                       class="font-semibold text-indigo-600 hover:text-indigo-500 hover:underline">
                        {{ __('messages.login') }}
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection