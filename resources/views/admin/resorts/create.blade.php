@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-2xl mx-auto px-4">

        <div class="mb-6">
            <a href="{{ route('admin.resorts.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">
                &larr; {{ __('messages.back_to_admin') }}
            </a>
            <h1 class="text-3xl font-extrabold text-slate-950 mt-2">
                {{ __('messages.create_new_resort') }}
            </h1>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
            <form action="{{ route('admin.resorts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.country') }}</label>
                    <select name="country_id" class="bg-white border border-slate-300 text-slate-900 rounded-xl p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <option value="">{{ __('messages.select_country') }}</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
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
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('messages.resort_name_placeholder') }}"
                           class="bg-white border border-slate-300 text-slate-900 rounded-xl p-2.5 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.description') }}</label>
                    <textarea name="description" rows="5" placeholder="{{ __('messages.description_placeholder') }}"
                              class="bg-white border border-slate-300 text-slate-900 rounded-xl p-3 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.resort_image') }}</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-slate-300 rounded-xl p-1.5 bg-white">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div> 

                <div class="pt-2">
                    <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 px-6 rounded-xl transition-colors duration-200 text-sm shadow-sm">
                        {{ __('messages.create_resort') }}
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection