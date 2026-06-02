@php
use Illuminate\Support\Str;
@endphp
@extends('layouts.app')

@section('content')

{{-- Gaišs, tīrs fons, kas lieliski sader ar jebkuru navigācijas joslu --}}
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4">
        
        {{-- Elegants, kreisajā pusē izlīdzināts virsraksts --}}
        <div class="border-b border-slate-200 pb-5 mb-8">
            <h1 class="text-3xl font-extrabold text-slate-950 tracking-tight">
                Slēpošanas kūrorti
            </h1>
            <p class="text-slate-500 mt-1">
                Atklāj labākos ziemas galamērķus un trases
            </p>
        </div>

        {{-- Kūrortu saraksts (3 kolonnas) --}}
        <div class="grid md:grid-cols-3 gap-6">

            @foreach($resorts as $resort)
                {{-- Kartiņa ar maigu, elegantu kustību uz augšu (hover:-translate-y-1) --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/80 p-4
                            transform transition-all duration-300 ease-out 
                            hover:-translate-y-1 hover:shadow-md flex flex-col">
                    
                    {{-- Glīts bildes rāmis ar noapaļotiem stūriem --}}
                    <div class="h-44 rounded-lg overflow-hidden bg-slate-100 mb-4">
                        <img src="{{ $resort->image ? asset('storage/' . $resort->image) : 'https://images.unsplash.com/photo-1605540436563-5bca919ae766?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                             alt="{{ $resort->name }}" 
                             class="w-full h-full object-cover">
                    </div>

                    {{-- Info daļa --}}
                    <div class="flex flex-col flex-grow">
                        {{-- Mazs valsts indikators --}}
                        <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-1">
                            📍 {{ $resort->country->name ?? 'Nav valsts' }}
                        </span>

                        {{-- Kūrorta nosaukums --}}
                        <h2 class="text-lg font-bold text-slate-900 mb-2">
                            {{ $resort->name }}
                        </h2>

                        {{-- Apraksts --}}
                        <p class="text-slate-600 text-sm mb-5 flex-grow leading-relaxed">
                            {{ Str::limit($resort->description, 95) }}
                        </p>

                        {{-- Gaumīga un tīra poga --}}
                        <a href="{{ route('resorts.show', $resort) }}"
                           class="block w-full text-center bg-slate-900 hover:bg-indigo-600 text-white font-medium py-2.5 px-4 rounded-lg transition-colors duration-200 text-sm">
                            Skatīt detaļas
                        </a>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</div>

@endsection