@extends('layouts.app')

@section('content')

<h1 class="text-4xl font-bold mb-8">
    My Wishlist
</h1>

@foreach($items as $item)

<div class="bg-white p-4 rounded shadow mb-4">

    <h2 class="font-bold">
        {{ $item->resort->name }}
    </h2>

    <form
        action="{{ route('wishlist.destroy', $item) }}"
        method="POST">

        @csrf
        @method('DELETE')

        <button
            class="text-red-600">

            Remove

        </button>

    </form>

</div>

@endforeach

@endsection