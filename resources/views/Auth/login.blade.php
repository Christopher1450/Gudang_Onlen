<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Gudang Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-100 via-blue-200 to-blue-400">
    <div class="flex w-full max-w-5xl rounded-xl shadow-xl overflow-hidden bg-white">
        {{-- Kiri: Form Login --}}
        <div class="w-full md:w-1/2 p-8">
            <div class="flex flex-col items-center mb-6">
                <div class="w-24 h-24 bg-blue-100 border border-blue-500 rounded-full flex items-center justify-center mb-3">
                    <span class="text-2xl font-bold text-blue-600">MM</span>
                </div>
                <h2 class="text-xl font-bold text-gray-700">Log In</h2>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" class="mt-1 w-full px-3 py-2 border rounded shadow-sm focus:outline-blue-500" value="{{ old('username') }}" required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 w-full px-3 py-2 border rounded shadow-sm focus:outline-blue-500" required>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Log In</button>
            </form>

            <p class="mt-4 text-xs text-center text-gray-400">© {{ date('Y') }} Gudang Online</p>
        </div>

        {{-- Kanan: Branding --}}
        <div class="hidden md:flex w-1/2 bg-gradient-to-r from-blue-500 to-indigo-600 items-center justify-center">
            <div class="text-center text-white px-6">
                <h1 class="text-3xl font-bold mb-2">GUDANG ONLINE</h1>
                <p class="text-sm">Product Management System</p>
            </div>
        </div>
    </div>
</body>
</html>
