@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">

    @if($resort->image)
        <div class="max-w-4xl mx-auto px-4 mb-6">
            <div class="overflow-hidden rounded-2xl shadow-sm border border-slate-200 bg-white">
                <img src="{{ asset('storage/' . $resort->image) }}"
                    alt="{{ $resort->name }}"
                    class="w-full h-64 sm:h-96 object-cover">
            </div>
        </div>
    @endif
    <div class="max-w-4xl mx-auto px-4">
     
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8 mb-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-4">
                <div>
                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider">
                        {{ $resort->country->name ?? __('messages.no_country') }}
                    </span>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-950 mt-1">
                        {{ $resort->name }}
                    </h1>
                </div>

                @auth
                    <form action="{{ route('wishlist.store') }}" method="POST" class="shrink-0">
                        @csrf
                        <input type="hidden" name="resort_id" value="{{ $resort->id }}">
                        <button class="inline-flex items-center gap-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white font-semibold py-2.5 px-4 rounded-xl transition-all duration-200 text-sm border border-rose-100 shadow-sm">
                            ❤️ {{ __('messages.add_to_wishlist') }}
                        </button>
                    </form>
                @endauth
            </div>

            <p class="text-slate-700 leading-relaxed text-base">
                {{ $resort->description }}
            </p>
        </div>

        <div class="mt-6 border-t border-slate-200 pt-6">
            <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                🌤️ {{ __('messages.live_weather') ?? 'Live Weather' }}
            </h2>

            @if($weather)
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                            {{ __('messages.temperature') ?? 'Temperature' }}
                        </p>
                        <p class="text-2xl font-extrabold text-slate-950 mt-1">
                            {{ $weather['temperature'] }} {{ $weather['temperature_unit'] }}
                        </p>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                            {{ __('messages.wind_speed') ?? 'Wind Speed' }}
                        </p>
                        <p class="text-2xl font-extrabold text-slate-950 mt-1">
                            {{ $weather['wind_speed'] }} {{ $weather['wind_speed_unit'] }}
                        </p>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                            {{ __('messages.precipitation') ?? 'Precipitation' }}
                        </p>
                        <p class="text-2xl font-extrabold text-slate-950 mt-1">
                            {{ $weather['precipitation'] }} {{ $weather['precipitation_unit'] }}
                        </p>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                            {{ __('messages.humidity') ?? 'Humidity' }}
                        </p>
                        <p class="text-2xl font-extrabold text-slate-950 mt-1">
                            {{ $weather['humidity'] }} {{ $weather['humidity_unit'] }}
                        </p>
                    </div>
                </div>

                <div class="mt-4 text-sm text-slate-500">
                    <p>
                        <span class="font-semibold text-slate-700">
                            {{ __('messages.conditions') ?? 'Conditions' }}:
                        </span>
                        {{ $weather['description'] }}
                    </p>

                    @if($weather['time'])
                        <p>
                            <span class="font-semibold text-slate-700">
                                {{ __('messages.updated_at') ?? 'Updated at' }}:
                            </span>
                            {{ $weather['time'] }}
                        </p>
                    @endif
                </div>

                <p class="text-xs text-slate-400 mt-3">
                    {{ __('messages.weather_source') ?? 'Weather data provided by Open-Meteo.' }}
                </p>
            @else
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200 text-slate-500 text-sm">
                    {{ __('messages.weather_unavailable') ?? 'Weather data is currently unavailable for this resort.' }}
                </div>
            @endif
        </div>

        <div class="border-t border-slate-200 pt-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                {{ __('messages.reviews') }} ({{ $resort->reviews->count() }})
            </h2>

            
            @auth
                <div class="bg-slate-100 rounded-2xl p-6 mb-8 border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">{{ __('messages.write_review') }}</h3>
                    
                    <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="resort_id" value="{{ $resort->id }}">

                        <div class="grid md:grid-cols-3 gap-4 items-center">
                            <div class="md:col-span-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.rating') }}</label>
                                <select name="rating" class="bg-white border border-slate-300 text-slate-900 rounded-xl p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                    <option value="5">⭐⭐⭐⭐⭐ ({{ __('messages.stars_5') }})</option>
                                    <option value="4">⭐⭐⭐⭐ ({{ __('messages.stars_4') }})</option>
                                    <option value="3">⭐⭐⭐ ({{ __('messages.stars_3') }})</option>
                                    <option value="2">⭐⭐ ({{ __('messages.stars_2') }})</option>
                                    <option value="1">⭐ ({{ __('messages.stars_1') }})</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.your_comment') }}</label>
                            <textarea name="comment" rows="4" required placeholder="{{ __('messages.comment_placeholder') }}" 
                                      class="bg-white border border-slate-300 text-slate-900 rounded-xl p-3 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm placeholder:text-slate-400"></textarea>
                        </div>

                        <button class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 px-5 rounded-xl transition-colors duration-200 text-sm shadow-sm">
                            {{ __('messages.submit_review') }}
                        </button>
                    </form>
                </div>
            @endauth

            <div class="space-y-4">
                @forelse($resort->reviews as $review)
                    <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm relative group">
                        
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <span class="font-bold text-slate-900 text-sm block">{{ $review->user->name }}</span>
                                <span class="text-amber-500 text-xs font-bold tracking-wider">
                                    {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                </span>
                            </div>

                            @if(auth()->check() && (auth()->id() === $review->user_id || auth()->user()->role === 'admin'))
                                <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 hover:underline text-xs font-bold transition-colors duration-200 bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded-md">
                                        {{ __('messages.delete') }}
                                    </button>
                                </form>
                            @endif
                        </div>

                        <p class="text-slate-600 text-sm leading-relaxed">
                            {{ $review->comment }}
                        </p>
                    </div>
                @empty
                    <div class="text-center py-8 bg-white rounded-xl border border-dashed border-slate-300">
                        <p class="text-slate-400 text-sm">{{ __('messages.no_reviews_yet') }}</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection