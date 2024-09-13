@extends('layouts.admin')

@section('content')
    <div class="mx-auto mt-12 max-w-7xl">
        <div class="flex items-center justify-between">
            <h1 class="mb-4 text-2xl font-semibold">Words</h1>
            <a href="{{ route('admin.word.create') }}" class="px-5 py-1 text-white bg-blue-400 border rounded hover:bg-blue-500">Create</a>
        </div>

        <table class="w-full mb-4 border">
            <thead class="border">
                <tr>
                    <th class="px-2.5 py-3 text-left">#</th>
                    <th class="px-2.5 py-3 text-left">Word</th>
                    <th class="px-2.5 py-3 text-left">Language</th>
                    <th class="px-2.5 py-3 text-left">Category</th>
                    <th class="px-2.5 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($words as $word)
                    <tr class="align-top border">
                        <td class="px-2.5 py-3 text-left">{{ $loop->iteration }}</td>
                        <td class="px-2.5 py-3 text-left">
                            <span class="text-sm">{{ $word->daily_text }}</span> <br>
                            {{ $word->formal_text }}
                        </td>
                        <td class="px-2.5 py-3 text-left">
                            {{ $word->language }}
                        </td>
                        <td class="px-2.5 py-3 text-left">{{ $word->category->name }}</td>
                        <td class="px-2.5 py-3 text-center flex w-full justify-center gap-5">
                            <a href="{{ route('admin.word.edit', ['w' => $word->slug, 'g' => $word->group_id]) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $words->links() }}
    </div>
@endsection
