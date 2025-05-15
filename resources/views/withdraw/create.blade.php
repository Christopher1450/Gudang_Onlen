@extends('layouts.app')

@section('content')
    <h2>📤 Catat Barang Keluar</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('withdraw.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_item" class="form-label">Pilih Barang:</label>
            <select name="kode_item" id="kode_item" class="form-select" required>
                <option value="">-- Pilih Barang --</option>
                @foreach ($items as $item)
                    <option value="{{ $item->kode_item }}">{{ $item->nama_item }} ({{ $item->kode_item }}) | Stok: {{ $item->stok }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Keluar:</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="nama_pengambil" class="form-label">Nama Pengambil:</label>
            <input type="text" name="nama_pengambil" id="nama_pengambil" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_pengambilan" class="form-label">Tanggal Pengambilan:</label>
            <input type="date" name="tanggal_pengambilan" id="tanggal_pengambilan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi (Opsional):</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan Barang Keluar</button>
        <a href="{{ route('withdraw.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
