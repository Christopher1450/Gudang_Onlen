<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Gudang Online</a>
            <div>
                <span class="me-2">{{ auth()->user()->username }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="mt-10">
        <h3 class="text-xl font-semibold mb-3">📈 Ringkasan Stok Masuk & Keluar</h3>
        <canvas id="stockChart" height="100"></canvas>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('stockChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chart_labels) !!},
                    datasets: [
                        {
                            label: 'Barang Masuk',
                            backgroundColor: 'rgba(54, 162, 235, 0.7)',
                            data: {!! json_encode($chart_in) !!}
                        },
                        {
                            label: 'Barang Keluar',
                            backgroundColor: 'rgba(255, 99, 132, 0.7)',
                            data: {!! json_encode($chart_out) !!}
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
        </script>


    <div class="container">
        @yield('content')
    </div>
</body>
</html>
