@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-2xl mx-auto px-4">

        <div class="mb-6">
            <a href="{{ route('admin.resorts.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">
                &larr; {{ __('messages.back_to_admin') }}
            </a>
            <h1 class="text-3xl font-extrabold text-slate-950 mt-2">
                {{ __('messages.edit_resort') }}: {{ $resort->name }}
            </h1>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
            <form action="{{ route('admin.resorts.update', $resort->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.country') }}</label>
                    <select name="country_id" class="bg-white border border-slate-300 text-slate-900 rounded-xl p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id', $resort->country_id) == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.resort_name') }}</label>
                    <input type="text" name="name" value="{{ old('name', $resort->name) }}"
                           class="bg-white border border-slate-300 text-slate-900 rounded-xl p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.description') }}</label>
                    <textarea name="description" rows="5" 
                              class="bg-white border border-slate-300 text-slate-900 rounded-xl p-3 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">{{ old('description', $resort->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.resort_image') }}</label>

                    @if($resort->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $resort->image) }}"
                                alt="{{ $resort->name }}"
                                class="h-32 w-full object-cover rounded-xl border">
                        </div>
                    @endif

                    <input type="file" name="image" accept="image/*"
                        class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-slate-300 rounded-xl p-1.5 bg-white">

                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center space-x-3 pt-2">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 px-6 rounded-xl transition-colors duration-200 text-sm shadow-sm">
                        {{ __('messages.update_resort') }}
                    </button>
                    <a href="{{ route('admin.resorts.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2.5 px-6 rounded-xl transition-colors duration-200 text-sm border border-slate-200">
                        {{ __('messages.cancel') }}
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection