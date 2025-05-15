@extends('layouts.app')

@section('content')
    <h2>📤 List Barang Keluar</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('withdraw.create') }}" class="btn btn-primary mb-3">+ Catat Barang Keluar</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Item</th>
                <th>Jumlah</th>
                <th>Nama Pengambil</th>
                <th>Tanggal Pengambilan</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->item->nama_item ?? '-' }}</td>
                    <td>{{ $log->jumlah }}</td>
                    <td>{{ $log->nama_pengambil }}</td>
                    <td>{{ $log->tanggal_pengambilan }}</td>
                    <td>{{ $log->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $logs->links() }}
@endsection
