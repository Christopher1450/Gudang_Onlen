@extends('layouts.app')

@section('content')
<h2>📥 Catat Barang Masuk</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('items.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="kode_item" class="form-label">Pilih Barang:</label>
        <select name="kode_item" id="kode_item" class="form-select" required>
            <option value="">-- Pilih Barang --</option>
            @foreach ($items as $item)
                <option value="{{ $item->kode_item }}">{{ $item->nama_item }} ({{ $item->kode_item }})</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah Masuk:</label>
        <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
    </div>

    <div class="mb-3">
        <label for="supplier_id" class="form-label">Supplier:</label>
        <select name="supplier_id" id="supplier_id" class="form-select" required>
            <option value="">-- Pilih Supplier --</option>
            @foreach (\App\Models\Supplier::all() as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="tanggal_masuk" class="form-label">Tanggal Masuk:</label>
        <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi (Opsional):</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Simpan Barang Masuk</button>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
