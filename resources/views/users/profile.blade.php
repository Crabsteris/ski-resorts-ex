@extends('layouts.app')

@section('content')

<h1 class="text-4xl font-bold mb-6">
    {{ $user->name }}
</h1>

<h2 class="text-2xl font-bold mb-4">
    My Reviews
</h2>

@foreach($reviews as $review)

<div class="bg-white p-4 rounded shadow mb-4">

    <h3 class="font-bold">
        {{ $review->resort->name }}
    </h3>

    <div>
        Rating: {{ $review->rating }}/5
    </div>

    <p>
        {{ $review->comment }}
    </p>

</div>

@endforeach

@endsection