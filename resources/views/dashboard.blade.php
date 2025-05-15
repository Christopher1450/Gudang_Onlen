<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Gudang Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-gray-800">Gudang Online - Admin</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
        </form>
    </nav>

    <!-- Dashboard Content -->
    <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-4 rounded shadow text-center">
                <h2 class="text-gray-600">Total Barang</h2>
                <p class="text-2xl font-bold text-blue-600">{{ $total_items ?? 0 }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <h2 class="text-gray-600">Order Hari Ini</h2>
                <p class="text-2xl font-bold text-green-600">{{ $order_today ?? 0 }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <h2 class="text-gray-600">Total Invoice</h2>
                <p class="text-2xl font-bold text-indigo-600">{{ $invoice_count ?? 0 }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <h2 class="text-gray-600">Jumlah Pengguna</h2>
                <p class="text-2xl font-bold text-yellow-600">{{ $user_count ?? 0 }}</p>
            </div>
        </div>

        <!-- Notifikasi stok minimum -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-2 text-red-600">⚠️ Stok Minimum</h3>
            <ul class="list-disc pl-5 text-red-700">
                @forelse ($low_stock_items ?? [] as $item)
                    <li>{{ $item->nama_item }} - Sisa: {{ $item->stok }} / Min: {{ $item->minimum_stok }}</li>
                @empty
                    <li class="text-green-600">Semua stok aman ✅</li>
                @endforelse
            </ul>
        </div>

        <!-- Chart section -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-3">📈 Grafik Barang Masuk & Keluar</h3>
            <canvas id="stockChart" height="100"></canvas>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('stockChart').getContext('2d');
        const stockChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chart_labels) !!},
                datasets: [
                    {
                        label: 'Barang Masuk',
                        backgroundColor: 'rgba(59, 130, 246, 0.6)',
                        data: {!! json_encode($chart_in) !!},
                    },
                    {
                        label: 'Barang Keluar',
                        backgroundColor: 'rgba(239, 68, 68, 0.6)',
                        data: {!! json_encode($chart_out) !!},
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
