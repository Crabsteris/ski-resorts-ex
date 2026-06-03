@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4">

        {{-- Sveiciena bloks visiem lietotājiem --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8 mb-8">
            <h1 class="text-3xl font-extrabold text-slate-950">
                Sveiks, {{ Auth::user()->name }}!
            </h1>
            <p class="text-slate-500 mt-2">
                Tu esi ielogojies kā: <span class="font-bold text-indigo-600 uppercase text-xs">{{ Auth::user()->role }}</span>
            </p>
        </div>

        {{--  ŠO REDZĒS TIKAI ADMINISTRATORS --}}
        @if(auth()->user()->role === 'admin')
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 mb-8">
                <h2 class="text-xl font-bold text-amber-800 mb-2"> Administratora panelis</h2>
                <p class="text-amber-700 text-sm mb-4">Tev ir pieejamas tiesības pārvaldīt sistēmas datus.</p>
                
                <div class="flex gap-4">
                    {{-- Šeit vari ielikt pogu uz kūrorta izveides formu, kad tev tāda būs --}}
                    <a href="{{ route('admin.resorts.index') }}" class="bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded-lg text-sm transition-colors">
                        + Pievienot jaunu kūrortu
                    </a>
                </div>
            </div>
        @endif

        {{-- ŠO REDZ VISI (Gan parastie lietotāji, gan admini) --}}
        <div class="grid md:grid-cols-2 gap-6">
            
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1"> Pētīt kūrortus</h3>
                    <p class="text-slate-500 text-sm mb-4">Apskati labākās slēpošanas trases un dodies piedzīvojumā.</p>
                </div>
                <a href="{{ route('resorts.index') }}" class="inline-block text-center bg-slate-900 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 text-sm">
                    Uz kūrortu sarakstu
                </a>
            </div>

            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1"> Mans vēlmju saraksts</h3>
                    <p class="text-slate-500 text-sm mb-4">Apskati kūrortus, kurus esi saglabājis vēlākam.</p>
                </div>
                <a href="{{ route('wishlist.index') }}" class="inline-block text-center bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm border border-rose-100">
                    Skatīt Wishlist
                </a>
            </div>

        </div>

    </div>
</div>
@endsection