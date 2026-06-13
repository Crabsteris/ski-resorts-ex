@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4">

        {{-- Virsraksta daļa --}}
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-slate-950">
                {{ __('messages.my_wishlist') }}
            </h1>

            <p class="text-slate-500 text-sm mt-1">
                {{ __('messages.wishlist_description') }}
            </p>
        </div>

        {{-- Saraksta režģis --}}
        <div class="grid gap-4 sm:grid-cols-2">
            @forelse($items as $item)
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between transition-all hover:shadow-md">
                    <div>
                        <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider block mb-1">
                            {{ $item->resort->country->name ?? __('messages.ski_resort') }}
                        </span>

                        <h2 class="text-xl font-bold text-slate-900">
                            {{ $item->resort->name }}
                        </h2>
                    </div>

                    {{-- Noņemšanas forma --}}
                    <form action="{{ route('wishlist.destroy', $item) }}" method="POST" class="m-0 p-0">
                        @csrf
                        @method('DELETE')

                        <button type="submit" 
                                class="inline-flex items-center justify-center bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white text-xs font-semibold px-3 py-2 rounded-xl border border-rose-100 transition-all duration-200 shadow-sm">
                            {{ __('messages.remove') }}
                        </button>
                    </form>
                </div>
            @empty
                {{-- Tukša stāvokļa paziņojums --}}
                <div class="sm:col-span-2 bg-white text-center py-12 px-4 rounded-2xl border border-slate-200 shadow-sm">
                    <p class="text-slate-400 italic mb-4">
                        {{ __('messages.wishlist_empty') }}
                    </p>

                    <a href="{{ route('resorts.index') }}" 
                       class="inline-flex items-center justify-center bg-slate-900 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-xl transition-colors duration-200 text-sm">
                        {{ __('messages.explore_resorts') }}
                    </a>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection