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

 
        <div class="grid md:grid-cols-3 gap-6">

            @foreach($resorts as $resort)
                
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 p-4
                            transform transition-all duration-300 ease-out
                            hover:-translate-y-1 hover:shadow-md flex flex-col">

                    
                    <div class="h-44 rounded-lg overflow-hidden bg-slate-100 mb-4">
                        <img src="{{ $resort->image ? asset('storage/' . $resort->image) : asset('images/default-resort-immage.avif') }}"
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
            @endforeach

        </div>
        <div class="mt-8">
            {{ $resorts->links() }}
        </div>
    </div>
</div>

@endsection