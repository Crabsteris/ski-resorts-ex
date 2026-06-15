@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">

    @php
        $hasImage = $resort->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($resort->image);

        $imagePath = $hasImage
            ? asset('storage/' . $resort->image)
            : asset('images/default-resort.jpg');
    @endphp

    <div class="max-w-4xl mx-auto px-4 mb-6">
        <div class="overflow-hidden rounded-2xl shadow-sm border border-slate-200 bg-white">
            <img src="{{ $imagePath }}"
                 alt="{{ $resort->name }}"
                 class="w-full h-64 sm:h-96 object-cover">
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4">

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8 mb-8">
            
            <div class="mb-4">
                <a href="{{ route('resorts.index', [], false) }}" class="text-sm font-semibold text-indigo-600 hover:underline">
                    &larr; {{ __('messages.explore_resorts') }}
                </a>
            </div>

            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 mb-3">
                {{ $resort->country->name ?? __('messages.no_country') }}
            </span>

            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-950 tracking-tight mb-4">
                {{ $resort->name }}
            </h1>

            <p class="text-slate-700 leading-relaxed text-base">
                {{ $resort->description }}
            </p>

            @auth
                <form action="{{ route('wishlist.store') }}" method="POST" class="mt-6">
                    @csrf

                    <input type="hidden" name="resort_id" value="{{ $resort->id }}">

                    <button type="submit"
                            class="inline-flex items-center justify-center bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white font-semibold py-2.5 px-5 rounded-xl transition-all duration-200 text-sm border border-rose-100">
                        ❤️ {{ __('messages.add_to_wishlist') }}
                    </button>
                </form>
            @endauth

            <div class="mt-6 border-t border-slate-200 pt-6">
                <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                     {{ __('messages.live_weather') }}
                </h2>

                @if($weather)
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                                {{ __('messages.temperature') }}
                            </p>
                            <p class="text-2xl font-extrabold text-slate-950 mt-1">
                                {{ $weather['temperature'] }} {{ $weather['temperature_unit'] }}
                            </p>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                                {{ __('messages.wind_speed') }}
                            </p>
                            <p class="text-2xl font-extrabold text-slate-950 mt-1">
                                {{ $weather['wind_speed'] }} {{ $weather['wind_speed_unit'] }}
                            </p>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                                {{ __('messages.precipitation') }}
                            </p>
                            <p class="text-2xl font-extrabold text-slate-950 mt-1">
                                {{ $weather['precipitation'] }} {{ $weather['precipitation_unit'] }}
                            </p>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                                {{ __('messages.humidity') }}
                            </p>
                            <p class="text-2xl font-extrabold text-slate-950 mt-1">
                                {{ $weather['humidity'] }} {{ $weather['humidity_unit'] }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 text-sm text-slate-500">
                        <p>
                            <span class="font-semibold text-slate-700">
                                {{ __('messages.conditions') }}:
                            </span>
                            {{ $weather['description'] }}
                        </p>

                        @if($weather['time'])
                            <p>
                                <span class="font-semibold text-slate-700">
                                    {{ __('messages.updated_at') }}:
                                </span>
                                {{ $weather['time'] }}
                            </p>
                        @endif
                    </div>

                    <p class="text-xs text-slate-400 mt-3">
                        {{ __('messages.weather_source') }}
                    </p>
                @else
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200 text-slate-500 text-sm">
                        {{ __('messages.weather_unavailable') }}
                    </div>
                @endif
            </div>

        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">

            <h2 class="text-2xl font-bold text-slate-900 mb-6">
                {{ __('messages.reviews') }} ({{ $resort->reviews->count() }})
            </h2>

            @auth
                <div class="bg-slate-50 rounded-xl border border-slate-200 p-5 mb-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">
                        {{ __('messages.write_review') }}
                    </h3>

                    <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <input type="hidden" name="resort_id" value="{{ $resort->id }}">

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">
                                {{ __('messages.rating') }}
                            </label>

                            <select name="rating"
                                    required
                                    class="bg-white border border-slate-300 text-slate-900 rounded-xl p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                <option value="5">⭐⭐⭐⭐⭐ {{ __('messages.stars_5') }}</option>
                                <option value="4">⭐⭐⭐⭐ {{ __('messages.stars_4') }}</option>
                                <option value="3">⭐⭐⭐ {{ __('messages.stars_3') }}</option>
                                <option value="2">⭐⭐ {{ __('messages.stars_2') }}</option>
                                <option value="1">⭐ {{ __('messages.stars_1') }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">
                                {{ __('messages.your_comment') }}
                            </label>

                            <textarea name="comment"
                                      rows="4"
                                      required
                                      placeholder="{{ __('messages.comment_placeholder') }}"
                                      class="bg-white border border-slate-300 text-slate-900 rounded-xl p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"></textarea>
                        </div>

                        <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 px-5 rounded-xl transition-colors duration-200 text-sm shadow-sm">
                            {{ __('messages.submit_review') }}
                        </button>
                    </form>
                </div>
            @endauth

            <div class="space-y-4">
                @forelse($resort->reviews as $review)
                    <div class="bg-slate-50 rounded-xl border border-slate-200 p-5">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div>
                                <p class="font-bold text-slate-900">
                                    {{ $review->user->name ?? __('messages.system_deleted_user') }}
                                </p>

                                <p class="text-amber-500 text-sm font-bold tracking-wider">
                                    {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                </p>
                            </div>

                            @auth
                                @if(auth()->id() === $review->user_id || auth()->user()->role === 'admin')
                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-500 hover:text-red-700 hover:underline text-xs font-bold transition-colors duration-200">
                                            {{ __('messages.delete') }}
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>

                        <p class="text-slate-600 text-sm leading-relaxed">
                            {{ $review->comment }}
                        </p>
                    </div>
                @empty
                    <div class="text-center py-10 border border-dashed border-slate-300 rounded-xl">
                        <p class="text-slate-400 text-sm">
                            {{ __('messages.no_reviews_yet') }}
                        </p>
                    </div>
                @endforelse
            </div>

        </div>

    </div>
</div>
@endsection