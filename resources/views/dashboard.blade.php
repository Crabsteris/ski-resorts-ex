@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4">

        {{-- Sveiciena bloks visiem lietotājiem --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8 mb-8">
            <h1 class="text-3xl font-extrabold text-slate-950">
                {{ __('messages.welcome') }}, {{ Auth::user()->name }}!
            </h1>

            <p class="text-slate-500 mt-2">
                {{ __('messages.logged_in_as') }}
                <span class="font-bold text-indigo-600 uppercase text-xs">
                    {{ Auth::user()->role }}
                </span>
            </p>
        </div>

        {{-- ŠO REDZĒS TIKAI ADMINISTRATORS --}}
        @if(auth()->user()->role === 'admin')
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 mb-8">
                <h2 class="text-xl font-bold text-amber-800 mb-2">
                    {{ __('messages.admin_panel') }}
                </h2>

                <p class="text-amber-700 text-sm mb-4">
                    {{ __('messages.admin_panel_description') }}
                </p>
                
                <div class="flex gap-4">
                    <a href="{{ route('admin.resorts.index') }}" 
                       class="bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded-lg text-sm transition-colors">
                        + {{ __('messages.add_new_resort_button') }}
                    </a>
                </div>
            </div>
        @endif

        {{-- ŠO REDZ VISI --}}
        <div class="grid md:grid-cols-2 gap-6">
            
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">
                        {{ __('messages.explore_resorts_title') }}
                    </h3>

                    <p class="text-slate-500 text-sm mb-4">
                        {{ __('messages.explore_resorts_description') }}
                    </p>
                </div>

                <a href="{{ route('resorts.index') }}" 
                   class="inline-block text-center bg-slate-900 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 text-sm">
                    {{ __('messages.go_to_resorts') }}
                </a>
            </div>

            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">
                        {{ __('messages.my_wishlist_title') }}
                    </h3>

                    <p class="text-slate-500 text-sm mb-4">
                        {{ __('messages.my_wishlist_description') }}
                    </p>
                </div>

                <a href="{{ route('wishlist.index') }}" 
                   class="inline-block text-center bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 text-sm border border-rose-100">
                    {{ __('messages.view_wishlist') }}
                </a>
            </div>

        </div>

    </div>
</div>
@endsection