@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Selamat Datang, {{ $user->name }} ({{ $user->role }})</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        {{-- Barang Masuk --}}
        <div class="col">
            <a href="{{ route('items.index') }}" class="text-decoration-none">
                <div class="card h-100 text-white bg-primary menu-card">
                    <div class="card-body text-center">
                        <h3><i class="fas fa-box-open"></i> Barang Masuk</h3>
                        <p>Catat stok barang masuk ke gudang</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Barang Keluar --}}
        <div class="col">
            <a href="{{ route('withdraw.index') }}" class="text-decoration-none">
                <div class="card h-100 text-white bg-success menu-card">
                    <div class="card-body text-center">
                        <h3><i class="fas fa-dolly"></i> Barang Keluar</h3>
                        <p>Catat pengeluaran stok barang</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Manajemen User --}}
        @if($user->role === 'admin' || $user->role === 'super_admin')
        <div class="col">
            <a href="{{ route('users.index') }}" class="text-decoration-none">
                <div class="card h-100 text-white bg-warning menu-card">
                    <div class="card-body text-center">
                        <h3><i class="fas fa-users-cog"></i> Manajemen User</h3>
                        <p>Tambah, edit, atau ubah role user</p>
                    </div>
                </div>
            </a>
        </div>
        @endif

        {{-- Log Aktivitas --}}
        <div class="col">
            <a href="{{ route('activity.index') }}" class="text-decoration-none">
                <div class="card h-100 text-white bg-dark menu-card">
                    <div class="card-body text-center">
                        <h3><i class="fas fa-history"></i> Log Aktivitas</h3>
                        <p>Lihat semua riwayat aktivitas gudang</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- CSS tambahan untuk scaling & hover --}}
    <style>
        .menu-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .menu-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            cursor: pointer;
        }
    </style>
@endsection
