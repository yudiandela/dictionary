@extends('layouts.admin')

@section('content')
    <div class="mx-auto my-6 lg:my-12 max-w-7xl">
        @if (session('success'))
            <div class="py-2.5 px-3 mb-4 text-sm text-white bg-green-600 rounded">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.word.index') }}" class="text-xs">Back to Index</a>
        <h1 class="mb-4 text-2xl font-semibold">Edit Words</h1>

        <form action="{{ route('admin.word.edit', ['w' => $words->first()->slug, 'g' => $words->first()->group_id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid gap-5 lg:grid-cols-2">
                @foreach ($words as $word)
                <div class="p-5 border rounded-md">
                    <input type="hidden" name="words[{{ $loop->index }}][id]" value="{{ $word->id }}">

                    <div class="mb-4">
                        <label for="daily_text" class="block mb-2 text-sm font-medium text-gray-900">Formal Text</label>
                        <input name="words[{{ $loop->index }}][formal_text]" autocomplete="off" value="{{ $word->formal_text }}" type="text" class="placeholder:italic placeholder:text-slate-400 w-full border rounded-md px-4 py-1.5 outline-none search-input placeholder:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="daily_text" class="block mb-2 text-sm font-medium text-gray-900">Daily Text</label>
                        <input name="words[{{ $loop->index }}][daily_text]" autocomplete="off" value="{{ $word->daily_text }}" type="text" class="placeholder:italic placeholder:text-slate-400 w-full border rounded-md px-4 py-1.5 outline-none search-input placeholder:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="daily_text" class="block mb-2 text-sm font-medium text-gray-900">Language</label>
                        <select name="words[{{ $loop->index }}][language_code]" id="" class="placeholder:italic placeholder:text-slate-400 w-full border rounded-md px-4 py-1.5 outline-none search-input placeholder:text-sm">
                            @foreach ($languages as $key => $lang)
                                <option value="{{ $key }}" {{ $word->language_code == $key ? 'selected' : '' }}>{{ $lang }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endforeach
            </div>

            <button type="submit" class="mt-4 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
        </form>
    </div>
@endsection
