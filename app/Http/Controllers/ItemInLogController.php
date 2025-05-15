<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemInLog;

class ItemInLogController extends Controller
{
    public function index()
    {
        $logs = ItemInLog::with('item')->latest()->paginate(10);
        return view('items.index', compact('logs'));
    }

    public function create()
    {
        $items = Item::all();
        return view('items.create', compact('items'));
    }

    public function store(Request $request)
{
    $request->validate([
        'kode_item'      => 'required|exists:items,kode_item',
        'jumlah'         => 'required|integer|min:1',
        'supplier_id'    => 'required|exists:suppliers,id',
        'deskripsi'      => 'nullable|string',
        'tanggal_masuk'  => 'required|date',
    ]);

    $id = uniqid('IN');
    ItemInLog::create([
        'id'             => $id,
        'kode_item'      => $request->kode_item,
        'jumlah'         => $request->jumlah,
        'supplier_id'    => $request->supplier_id,
        'deskripsi'      => $request->deskripsi,
        'tanggal_masuk'  => $request->tanggal_masuk,
    ]);

    // Update stok otomatis
    $item = \App\Models\Item::where('kode_item', $request->kode_item)->first();
    $item->stok += $request->jumlah;
    $item->save();

    // 🚀 Tambah log aktivitas
    ActivityLog::create([
        'id'         => uniqid('ACT'),
        'nama_id'    => auth()->user()->nama_id,  // Ambil dari user login
        'aktivitas'  => 'Input Barang Masuk',
        'keterangan' => 'Menambahkan '.$request->jumlah.' stok untuk item '.$item->nama_item.' ('.$request->kode_item.') dari supplier ID '.$request->supplier_id,
    ]);

    return redirect()->route('items.index')->with('success', 'Barang masuk berhasil dicatat, stok diperbarui, dan aktivitas tercatat!');
    }   
}