@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-5xl mx-auto px-4">

        {{-- Veiksmīgo paziņojumu bloks (Flash messages) --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Augšējā josla ar virsrakstu un pievienošanas pogu --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-950">{{ __('messages.manage_resorts') }}</h1>
                <p class="text-slate-500 text-sm mt-1">{{ __('messages.manage_resorts_description') }}</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.resorts.trash') }}" 
                class="inline-flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2.5 px-5 rounded-xl transition-colors duration-200 text-sm border border-slate-200 whitespace-nowrap">
                    🗑️ {{ __('messages.trash') ?? 'Trash' }}
                </a>

                <a href="{{ route('admin.resorts.create') }}" 
                class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 px-5 rounded-xl transition-colors duration-200 text-sm shadow-sm whitespace-nowrap">
                    + {{ __('messages.add_new_resort') }}
                </a>
            </div>
        </div>

        {{-- Kūrortu tabula --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-900 font-semibold">
                        <tr>
                            <th scope="col" class="px-6 py-4">{{ __('messages.resort_name') }}</th>
                            <th scope="col" class="px-6 py-4">{{ __('messages.country') }}</th>
                            <th scope="col" class="px-6 py-4 text-right">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($resorts as $resort)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-semibold text-slate-900">
                                    {{ $resort->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 border border-slate-200">
                                        {{ $resort->country->name ?? __('messages.n_a') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        {{-- Edit poga --}}
                                        <a href="{{ route('admin.resorts.edit', $resort->id) }}" 
                                           class="text-indigo-600 hover:text-indigo-900 font-semibold transition-colors">
                                            {{ __('messages.edit') }}
                                        </a>

                                        <span class="text-slate-300">|</span>

                                        
                                        <form action="{{ route('admin.resorts.destroy', $resort->id) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this resort?');" class="inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-600 hover:text-rose-900 font-semibold transition-colors">
                                                {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-slate-400 italic">
                                    {{ __('messages.no_resorts_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection