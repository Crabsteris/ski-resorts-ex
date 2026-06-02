@extends('layouts.app')

@section('content')

<div class="bg-white p-8 rounded-lg shadow">

    <h1 class="text-4xl font-bold mb-4">
        {{ $resort->name }}
    </h1>

    <p class="text-gray-500 mb-4">
        {{ $resort->country->name }}
    </p>

    <p class="mb-8">
        {{ $resort->description }}
    </p>
    
    @auth
        <form action="{{ route('wishlist.store') }}"
            method="POST">

            @csrf

            <input type="hidden"
                name="resort_id"
                value="{{ $resort->id }}">

            <button
                class="bg-green-600 text-white px-4 py-2 rounded">

                Add to Wishlist

            </button>

        </form>
        @endauth

    <hr class="my-6">

    <h2 class="text-2xl font-bold mb-4">
        Reviews
    </h2>

    @auth

    <div class="mb-8">

        <h2 class="text-2xl font-bold mb-4">
            Add Review
        </h2>

        <form action="{{ route('reviews.store') }}"
            method="POST"
            class="space-y-4">

            @csrf

            <input type="hidden"
                name="resort_id"
                value="{{ $resort->id }}">

            <div>

                <label class="block mb-1">
                    Rating
                </label>

                <select name="rating"
                        class="border rounded p-2 w-full">

                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>

                </select>

            </div>

            <div>

                <label class="block mb-1">
                    Comment
                </label>

                <textarea
                    name="comment"
                    rows="4"
                    class="border rounded p-2 w-full"></textarea>

            </div>

            <button
                class="bg-blue-700 text-white px-4 py-2 rounded">

                Submit Review

            </button>

        </form>

    </div>

    @endauth
    @forelse($resort->reviews as $review)

        <div class="border rounded p-4 mb-4">

            <strong>
                {{ $review->user->name }}
            </strong>

            @if(
                auth()->check() &&
                (
                    auth()->id() === $review->user_id ||
                    auth()->user()->role === 'admin'
                )
            )
                <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:underline text-sm font-semibold">
                        Delete
                    </button>
                </form>
            @endif

            <div>
                Rating: {{ $review->rating }}/5
            </div>

            <p>
                {{ $review->comment }}
            </p>

        </div>

    @empty

        <p>
            No reviews yet.
        </p>

    @endforelse

</div>

@endsection