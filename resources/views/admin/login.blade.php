<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Login') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="px-4 font-sans antialiased">
    <div class="flex items-center justify-center max-w-xl min-h-screen mx-auto">
        <div class="w-full p-8 border rounded-md">
            <h1 class="mb-4 text-3xl font-bold text-center">Login</h1>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label for="email" class="block pl-2 mb-2 text-sm">Email</label>
                <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" class="w-full px-2 py-2.5 border rounded-md">
                @error('email')
                    <span class="text-sm italic text-red-500">{{ $message }}</span>
                @enderror

                <label for="password" class="block pl-2 mt-4 mb-2 text-sm">Password</label>
                <input type="password" name="password" placeholder="Password" class="w-full px-2 py-2.5 border rounded-md">

                <button class="bg-blue-300 mt-4 py-2.5 px-3 rounded-md w-full hover:bg-blue-500 hover:text-white font-bold">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
