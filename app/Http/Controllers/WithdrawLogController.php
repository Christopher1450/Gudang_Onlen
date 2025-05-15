<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WithdrawLog;
use App\Models\Item;
use App\Models\ActivityLog;

class WithdrawLogController extends Controller
{
    public function index()
    {
        $logs = WithdrawLog::with('item')->latest()->paginate(10);
        return view('withdraw.index', compact('logs'));
    }

    public function create()
    {
        $items = Item::all();
        return view('withdraw.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_item'            => 'required|exists:items,kode_item',
            'jumlah'               => 'required|integer|min:1',
            'nama_pengambil'       => 'required|string',
            'deskripsi'            => 'nullable|string',
            'tanggal_pengambilan'  => 'required|date',
        ]);

        $item = Item::where('kode_item', $request->kode_item)->first();

        if ($item->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak cukup untuk pengambilan!');
        }

        // Buat log barang keluar
        WithdrawLog::create([
            'id'                   => uniqid('OUT'),
            'kode_item'            => $request->kode_item,
            'jumlah'               => $request->jumlah,
            'nama_id'              => auth()->user()->nama_id,
            'nama_pengambil'       => $request->nama_pengambil,
            'deskripsi'            => $request->deskripsi,
            'tanggal_pengambilan'  => $request->tanggal_pengambilan,
        ]);

        // Update stok: stok berkurang
        $item->stok -= $request->jumlah;
        $item->save();

        // Tambah log aktivitas
        ActivityLog::create([
            'id'          => uniqid('ACT'),
            'nama_id'     => auth()->user()->nama_id,
            'aktivitas'   => 'Pengeluaran Barang',
            'keterangan'  => 'Mengeluarkan '.$request->jumlah.' stok untuk item '.$item->nama_item.' ('.$request->kode_item.') oleh '.$request->nama_pengambil,
        ]);

        return redirect()->route('withdraw.index')->with('success', 'Barang keluar berhasil dicatat dan stok diperbarui!');
    }
}
