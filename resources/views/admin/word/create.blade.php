@extends('layouts.admin')

@section('content')
    <div class="mx-auto my-6 lg:my-12 max-w-7xl">
        @if (session('success'))
            <div class="py-2.5 px-3 mb-4 text-white bg-green-600 rounded">{{ session('success') }}</div>
        @endif

        <div class="flex items-end justify-between mb-4">
            <div>
                <a href="{{ route('admin.word.index') }}" class="text-xs">Back to Index</a>
                <h1 class="text-xl font-semibold">Create Words</h1>
            </div>

            <button type="button" class="px-5 py-1 text-white bg-blue-400 border rounded copy-element hover:bg-blue-500">Add</button>
        </div>

        <form action="{{ route('admin.word.create') }}" method="POST">
            @csrf

            <div class="grid gap-5 lg:grid-cols-2">
                <div class="p-5 border rounded-md card-component">
                    <div class="mb-4">
                        <label for="daily_text" class="block mb-2 font-medium text-gray-900">Formal Text</label>
                        <input name="words[formal_text][]" autocomplete="off" value="" type="text" class="placeholder:italic placeholder:text-slate-400 w-full border rounded-md px-4 py-1.5 outline-none search-input">
                    </div>

                    <div class="mb-4">
                        <label for="daily_text" class="block mb-2 font-medium text-gray-900">Daily Text</label>
                        <input name="words[daily_text][]" autocomplete="off" value="" type="text" class="placeholder:italic placeholder:text-slate-400 w-full border rounded-md px-4 py-1.5 outline-none search-input">
                    </div>

                    <div class="mb-4">
                        <label for="daily_text" class="block mb-2 font-medium text-gray-900">Language</label>
                        <select name="words[language_code][]" id="" class="placeholder:italic placeholder:text-slate-400 w-full border rounded-md px-4 py-1.5 outline-none search-input">
                            @foreach ($languages as $key => $lang)
                                <option value="{{ $key }}">{{ $lang }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="mt-4 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg  px-5 py-2.5 text-center">Save</button>
        </form>
    </div>
@endsection
