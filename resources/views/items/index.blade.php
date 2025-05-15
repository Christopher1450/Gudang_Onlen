@extends('layouts.app')

@section('content')
<h2>📦 List Barang Masuk</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('items.create') }}" class="btn btn-primary mb-3">+ Catat Barang Masuk</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Item</th>
            <th>Jumlah</th>
            <th>Supplier</th>
            <th>Tanggal Masuk</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->id }}</td>
            <td>{{ $log->item->nama_item ?? '-' }}</td>
            <td>{{ $log->jumlah }}</td>
            <td>{{ $log->supplier_id }}</td>
            <td>{{ $log->tanggal_masuk }}</td>
            <td>{{ $log->deskripsi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $logs->links() }}
@endsection
