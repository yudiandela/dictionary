@extends('layouts.app')

@section('content')
    <h1 class="mt-12 mb-8 text-3xl text-center">Welcome to {{ config('app.name') }}</h1>

    <div class="relative w-full">
        <div class="absolute hidden transform -translate-y-1/2 right-2 top-1/2 input-loader">
            <svg class="w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>

        <input autocomplete="off" value="{{ $inputText }}" type="text" name="search" class="placeholder:italic placeholder:text-slate-400 bg-gray-100 focus:bg-white w-full border rounded-md px-4 py-1.5 outline-none search-input placeholder:text-sm" placeholder="Search Word on Every Language">
    </div>

    <div id="autocomplete-list" class="mt-4 overflow-hidden border rounded-md search-list">
        @foreach ($words as $word)
        <a href="/?s={{ $word->slug }}&l={{ $word->language_code }}" class="flex items-center justify-between px-4 py-2 border-b hover:bg-gray-100 last:border-none autocomplete-items">
            <spam>{{ $word->formal_text }}</spam>
            <span class="text-xs text-gray-500">{{ $word->language }}</span>
        </a>
        @endforeach
    </div>

    @if($result->count() > 0)
        <div class="mt-16 mb-2 text-2xl text-center">Result</div>
        <div class="grid grid-cols-1 gap-4 mt-4">
            <div class="border rounded-md w-full min-h-[120px] p-4">
                <div class="text-3xl font-semibold">{{ $result->formal_text }}</div>
                <div class="text-sm italic">{{ $result->language }}</div>
                <div class="mt-4 text-xl">{{ $result->daily_text }}</div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            @foreach ($words as $item)
                <div class="border rounded-md w-full min-h-[120px] p-4">
                    <div class="text-3xl font-semibold">{{ $item->formal_text }}</div>
                    <div class="text-sm italic">{{ $item->language }}</div>
                    <div class="mt-4 text-xl">{{ $item->daily_text }}</div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
