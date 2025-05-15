<!-- resources/views/user/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-gray-800">Gudang Online - User</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
        </form>
    </nav>

    <div class="p-6">
        <h2 class="text-2xl font-semibold text-gray-700">Selamat datang, {{ Auth::user()->name }}!</h2>
        <p class="mt-2 text-gray-600">Ini adalah dashboard user. Di sini kamu bisa melihat katalog produk, melakukan pemesanan, dan memonitor status order kamu.</p>

        <div class="mt-6">
            <a href="#" class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Lihat Katalog</a>
        </div>
    </div>
</body>
</html>
