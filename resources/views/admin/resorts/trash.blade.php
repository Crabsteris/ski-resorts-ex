@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-5xl mx-auto px-4">

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <a href="{{ route('admin.resorts.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">
                    &larr; {{ __('messages.back_to_admin') }}
                </a>

                <h1 class="text-3xl font-extrabold text-slate-950 mt-2">
                    🗑️ {{ __('messages.deleted_resorts') ?? 'Deleted Resorts' }}
                </h1>

                <p class="text-slate-500 text-sm mt-1">
                    {{ __('messages.deleted_resorts_description') ?? 'Restore resorts that were previously deleted.' }}
                </p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-900 font-semibold">
                        <tr>
                            <th scope="col" class="px-6 py-4">{{ __('messages.resort_name') }}</th>
                            <th scope="col" class="px-6 py-4">{{ __('messages.country') }}</th>
                            <th scope="col" class="px-6 py-4">{{ __('messages.date') }}</th>
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

                                <td class="px-6 py-4 text-slate-500">
                                    {{ $resort->deleted_at?->format('d M Y, H:i') }}
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('admin.resorts.restore', $resort->id) }}" method="POST" class="inline m-0">
                                        @csrf

                                        <button type="submit" 
                                                class="bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-2 px-4 rounded-lg text-sm transition-colors">
                                            {{ __('messages.restore') ?? 'Restore' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">
                                    {{ __('messages.no_deleted_resorts') ?? 'No deleted resorts.' }}
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