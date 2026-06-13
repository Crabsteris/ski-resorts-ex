@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-5xl mx-auto px-4">

        <div class="mb-6">
            <a href="{{ route('admin.resorts.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">
                &larr; {{ __('messages.back_to_admin') }}
            </a>

            <h1 class="text-3xl font-extrabold text-slate-950 mt-2">
                {{ __('messages.audit_logs') }}
            </h1>

            <p class="text-slate-500 mt-1">
                {{ __('messages.audit_logs_description') }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold">{{ __('messages.user') }}</th>
                        <th class="text-left px-4 py-3 font-semibold">{{ __('messages.action') }}</th>
                        <th class="text-left px-4 py-3 font-semibold">{{ __('messages.description') }}</th>
                        <th class="text-left px-4 py-3 font-semibold">{{ __('messages.date') }}</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200">
                    @forelse($logs as $log)
                        <tr>
                            <td class="px-4 py-3 text-slate-700">
                                {{ $log->user->name ?? __('messages.system_deleted_user') }}
                            </td>

                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700">
                                    {{ $log->action }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-slate-700">
                                {{ $log->description }}
                            </td>

                            <td class="px-4 py-3 text-slate-500">
                                {{ $log->created_at->format('d M Y, H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-slate-500">
                                {{ $log->user->name ?? __('messages.system_deleted_user') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $logs->links() }}
        </div>

    </div>
</div>
@endsection