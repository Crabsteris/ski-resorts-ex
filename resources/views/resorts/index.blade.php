@php
use Illuminate\Support\Str;
@endphp
@extends('layouts.app')

@section('content')

<h1 class="text-4xl font-bold mb-8">
    Ski Resorts
</h1>

<div class="grid md:grid-cols-3 gap-6">

    @foreach($resorts as $resort)

        <div class="bg-white rounded-lg shadow p-6">

            <h2 class="text-2xl font-bold mb-2">
                {{ $resort->name }}
            </h2>

            <p class="text-gray-600 mb-2">
                {{ $resort->country->name }}
            </p>

            <p class="mb-4">
                {{ Str::limit($resort->description, 100) }}
            </p>

            <a href="{{ route('resorts.show', $resort) }}"
               class="text-blue-600 font-semibold">
                View Details →
            </a>

        </div>

    @endforeach

</div>

@endsection