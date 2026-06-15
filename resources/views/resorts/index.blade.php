@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    
    <div class="max-w-6xl mx-auto px-4">

        <div class="border-b border-slate-200 pb-5 mb-8">
            <h1 class="text-3xl font-extrabold text-slate-950 tracking-tight">
                {{ __('messages.resorts') }}
            </h1>

            <p class="text-slate-500 mt-1">
                {{ __('messages.discover_best_destinations') }}
            </p>
        </div>

        {{-- Search and filter form --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 mb-8">
            <form method="GET" action="{{ route('resorts.index', [], false) }}" class="grid md:grid-cols-4 gap-4 items-end">

                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-semibold text-slate-700 mb-1">
                        {{ __('messages.search_resort') ?? 'Search resort' }}
                    </label>

                    <input type="text"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="{{ __('messages.search_resort_placeholder') ?? 'Search by resort name...' }}"
                           class="bg-white border border-slate-300 text-slate-900 rounded-xl p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                </div>

                <div>
                    <label for="country" class="block text-sm font-semibold text-slate-700 mb-1">
                        {{ __('messages.country') }}
                    </label>

                    <select id="country"
                            name="country"
                            class="bg-white border border-slate-300 text-slate-900 rounded-xl p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <option value="">
                            {{ __('messages.all_countries') ?? 'All Countries' }}
                        </option>

                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ request('country') == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 px-4 rounded-xl transition-colors duration-200 text-sm shadow-sm">
                        {{ __('messages.filter') ?? 'Filter' }}
                    </button>

                    <a href="{{ route('resorts.index') }}"
                       class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2.5 px-4 rounded-xl transition-colors duration-200 text-sm border border-slate-200">
                        {{ __('messages.clear') ?? 'Clear' }}
                    </a>
                </div>

            </form>
        </div>

        {{-- Resort grid --}}
        <div class="grid md:grid-cols-3 gap-6">

            @forelse($resorts as $resort)
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 p-4
                            transform transition-all duration-300 ease-out
                            hover:-translate-y-1 hover:shadow-md flex flex-col">

                    <div class="h-44 rounded-lg overflow-hidden bg-slate-100 mb-4">
                        <img src="{{ $resort->image ? asset('storage/' . $resort->image) : asset('images/default-resort.jpg') }}"
                             alt="{{ $resort->name }}"
                             loading="lazy"
                             class="w-full h-full object-cover">
                    </div>

                    <div class="flex flex-col flex-grow">

                        <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-1">
                            {{ $resort->country->name ?? __('messages.no_country') }}
                        </span>

                        <h2 class="text-lg font-bold text-slate-900 mb-2">
                            {{ $resort->name }}
                        </h2>

                        <p class="text-slate-600 text-sm mb-5 flex-grow leading-relaxed">
                            {{ Str::limit($resort->description, 95) }}
                        </p>

                        <a href="{{ route('resorts.show', $resort) }}"
                           class="block w-full text-center bg-slate-900 hover:bg-indigo-600 text-white font-medium py-2.5 px-4 rounded-lg transition-colors duration-200 text-sm">
                            {{ __('messages.view_details') }}
                        </a>
                    </div>

                </div>
            @empty
                <div class="md:col-span-3 bg-white rounded-2xl border border-dashed border-slate-300 text-center py-12 px-4">
                    <p class="text-slate-400 text-sm">
                        {{ __('messages.no_resorts_match') ?? 'No resorts match your search or filter.' }}
                    </p>
                </div>
            @endforelse

        </div>

        <div class="mt-8">
            {{ $resorts->links() }}
        </div>

    </div>
</div>
@endsection