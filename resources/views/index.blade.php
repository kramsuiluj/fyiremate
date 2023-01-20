<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Fyiremate | Login</title>
</head>
<body class="bg-gray-100">
<div class="flex h-screen">
    <div class="m-auto">
        <div class="border shadow p-5 rounded bg-white" style="width: 25rem">
            <h2 class="font-daysone font-bold text-2xl tracking-wider text-center mb-4">
                <span class="text-orange-500">FYIRE</span><span class="text-blue-900">MATE</span>
            </h2>

            <hr>

            <form action="{{ route('login') }}" method="POST" class="font-montserrat space-y-6">
                @csrf

                <section class="space-y-8">
                    <div class="flex flex-col space-y-1 relative">
                        <label for="username" class="text-sm">Username</label>
                        <input type="text" name="username" class="rounded bg-gray-50" placeholder="Username" required>

                        @error('username')
                        <p class="text-xs text-red-500 absolute -bottom-4">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col space-y-1 relative">
                        <label for="password" class="text-sm">Password</label>
                        <input type="password" name="password" class="rounded bg-gray-50" placeholder="●●●●●●●●" required>
                    </div>
                </section>

                <div class="flex space-x-2">
                    <input type="checkbox" name="remember" class="rounded" value="1">
                    <label for="remember" class="text-sm">Remember me</label>
                </div>

                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-full"
                >
                    Log In
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
