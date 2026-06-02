@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4">

        {{-- Lietotāja profila galvenā sekcija --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8 mb-8 flex items-center gap-4">
            {{-- Apaļš profila iniciāļu aplis vizuālam akcentam --}}
            <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center text-white text-2xl font-black shadow-sm shrink-0">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider">User Profile</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-950 mt-0.5">
                    {{ $user->name }}
                </h1>
                <p class="text-sm text-slate-500">{{ $user->email }}</p>
            </div>
        </div>

        {{-- Lietotāja uzrakstītās atsauksmes --}}
        <div class="border-t border-slate-200 pt-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                My Reviews ({{ $reviews->count() }})
            </h2>

            <div class="space-y-4">
                @forelse($reviews as $review)
                    {{-- Atsauksmes kartiņa ar vieglu kustību --}}
                    <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm transition-all duration-200 hover:border-slate-300">
                        
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                {{-- Kūrorta nosaukums kā saite uz pašu kūrortu --}}
                                <a href="{{ route('resorts.show', $review->resort) }}" 
                                   class="font-bold text-slate-900 text-lg hover:text-indigo-600 hover:underline transition-colors duration-200 block">
                                    {{ $review->resort->name }}
                                </a>
                                {{-- Zvaigznīšu reitings --}}
                                <span class="text-amber-500 text-sm font-bold tracking-wider block mt-0.5">
                                    {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                </span>
                            </div>

                            {{-- Ja profila skatā arī gribi atļaut uzreiz izdzēst savu atsauksmi --}}
                            <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:text-red-700 hover:underline text-xs font-bold transition-colors duration-200 bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded-md">
                                    Delete
                                </button>
                            </form>
                        </div>

                        <p class="text-slate-600 text-sm leading-relaxed bg-slate-50 p-3 rounded-lg border border-slate-100">
                            {{ $review->comment }}
                        </p>
                        
                    </div>
                @empty
                    {{-- Tukšais stāvoklis, ja lietotājs vēl nav uzrakstījis nevienu atsauksmi --}}
                    <div class="text-center py-12 bg-white rounded-xl border border-dashed border-slate-300">
                        <p class="text-slate-400 text-sm mb-4">You haven't written any reviews yet.</p>
                        <a href="{{ route('resorts.index') }}" 
                           class="inline-flex bg-slate-900 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 text-sm">
                            Explore Resorts
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection