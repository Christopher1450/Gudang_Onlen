<?php

namespace App\Http\Controllers;

use App\Helpers\IdGenerator;
use Illuminate\Http\Request;
use App\Models\WithdrawLog;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WithdrawLogController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kode_item'   => 'required|exists:items,kode_item',
            'jumlah'      => 'required|integer|min:1',
            'deskripsi'   => 'nullable|string',
        ]);

        // Ambil data item
        $item = Item::where('kode_item', $request->kode_item)->first();

        // Cek stok cukup atau nggak
        if ($item->stok < $request->jumlah) {
            return response()->json(['message' => 'Stok tidak mencukupi!'], 400);
        }

        $id = IdGenerator::generateId('OUT', 'withdraw_logs');

        // Kurangi stok
        $item->stok -= $request->jumlah;
        $item->save();

        // Simpan log pengambilan
        WithdrawLog::create([
            'id'               => $id,
            'kode_item'        => $item->kode_item,
            'nama_item'        => $item->nama_item,
            'warna'            => $item->warna,
            'size'             => $item->size,
            'jumlah'           => $request->jumlah,
            'nama_id'          => Auth::user()->nama_id, // Ambil dari user yang login
            'nama_pengambil'   => Auth::user()->nama,    // Ambil dari user yang login
            'deskripsi'        => $request->deskripsi,
            'tanggal_pengambilan' => now(),
        ]);

        return response()->json(['message' => 'Barang berhasil diambil!', 'id' => $id], 201);
    }
}
