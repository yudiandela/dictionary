<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') ?? 'Dictionary' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="px-4 font-sans antialiased">
        <header class="container mx-auto flex h-[60px] items-center justify-between w-full">
            <a href="{{ route('home') }}" class="text-xl font-bold uppercase">D</a>

            <div class="flex gap-8">
                <ul class="flex gap-4">
                    @guest
                    <li class="pb-1 transition-all ease-in-out delay-150 border-b-2 border-transparent hover:border-black hover:border-b-2">
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    @endguest

                    @auth
                    <li class="pb-1 transition-all ease-in-out delay-150 border-b-2 border-transparent hover:border-black hover:border-b-2">
                        <a href="{{ route('admin.word.index') }}">Dictionary</a>
                    </li>
                    @endauth
                </ul>

                @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="pb-1 transition-all ease-in-out delay-150 border-b-2 border-transparent hover:border-black hover:border-b-2">Logout</button>
                </form>
                @endauth
            </div>
        </header>

        <section class="container mx-auto">
            @yield('content')
        </section>

        <footer class="text-sm text-center text-gray-500"></footer>
    </body>
</html>
