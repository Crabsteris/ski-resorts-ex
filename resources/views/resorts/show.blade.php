@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4">

        {{-- Galvenā kūrorta informācijas kartiņa --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8 mb-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-4">
                <div>
                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider">
                        📍 {{ $resort->country->name ?? 'Nav valsts' }}
                    </span>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-950 mt-1">
                        {{ $resort->name }}
                    </h1>
                </div>

                {{-- Wishlist poga --}}
                @auth
                    <form action="{{ route('wishlist.store') }}" method="POST" class="shrink-0">
                        @csrf
                        <input type="hidden" name="resort_id" value="{{ $resort->id }}">
                        <button class="inline-flex items-center gap-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white font-semibold py-2.5 px-4 rounded-xl transition-all duration-200 text-sm border border-rose-100 shadow-sm">
                            ❤️ Add to Wishlist
                        </button>
                    </form>
                @endauth
            </div>

            <p class="text-slate-700 leading-relaxed text-base">
                {{ $resort->description }}
            </p>
        </div>

        {{-- Atsauksmju sekcija --}}
        <div class="border-t border-slate-200 pt-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                Reviews ({{ $resort->reviews->count() }})
            </h2>

            {{-- Jaunas atsauksmes pievienošanas forma --}}
            @auth
                <div class="bg-slate-100 rounded-2xl p-6 mb-8 border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Write a Review</h3>
                    
                    <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="resort_id" value="{{ $resort->id }}">

                        <div class="grid md:grid-cols-3 gap-4 items-center">
                            <div class="md:col-span-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Rating</label>
                                <select name="rating" class="bg-white border border-slate-300 text-slate-900 rounded-xl p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                    <option value="5">⭐⭐⭐⭐⭐ (5 Stars)</option>
                                    <option value="4">⭐⭐⭐⭐ (4 Stars)</option>
                                    <option value="3">⭐⭐⭐ (3 Stars)</option>
                                    <option value="2">⭐⭐ (2 Stars)</option>
                                    <option value="1">⭐ (1 Star)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Your Comment</label>
                            <textarea name="comment" rows="4" required placeholder="Share your experience about trails, snow conditions..." 
                                      class="bg-white border border-slate-300 text-slate-900 rounded-xl p-3 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm placeholder:text-slate-400"></textarea>
                        </div>

                        <button class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 px-5 rounded-xl transition-colors duration-200 text-sm shadow-sm">
                            Submit Review
                        </button>
                    </form>
                </div>
            @endauth

            {{-- Esošo atsauksmju saraksts --}}
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

                            {{-- Dzēšanas poga --}}
                            @if(auth()->check() && (auth()->id() === $review->user_id || auth()->user()->role === 'admin'))
                                <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 hover:underline text-xs font-bold transition-colors duration-200 bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded-md">
                                        Delete
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
                        <p class="text-slate-400 text-sm">No reviews yet. Be the first to leave one!</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection