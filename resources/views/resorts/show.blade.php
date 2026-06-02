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

    <hr class="my-6">

    <h2 class="text-2xl font-bold mb-4">
        Reviews
    </h2>

    @forelse($resort->reviews as $review)

        <div class="border rounded p-4 mb-4">

            <strong>
                {{ $review->user->name }}
            </strong>

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