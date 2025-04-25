<?php

namespace App\Http\Controllers;

use App\Helpers\IdGenerator;
use Illuminate\Http\Request;
use App\Models\ItemInLog;
use App\Models\Item;

class ItemInLogController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kode_item'    => 'required|exists:items,kode_item',
            'jumlah'       => 'required|integer|min:1',
            'supplier_id'  => 'required|exists:suppliers,id',
            'deskripsi'    => 'nullable|string',
        ]);

        $id = IdGenerator::generateId('IN', 'item_in_logs');

        // Tambah stok ke items
        $item = Item::where('kode_item', $request->kode_item)->first();
        $item->stok += $request->jumlah;
        $item->save();

        // Simpan log barang masuk
        ItemInLog::create([
            'id'             => $id,
            'kode_item'      => $request->kode_item,
            'jumlah'         => $request->jumlah,
            'supplier_id'    => $request->supplier_id,
            'deskripsi'      => $request->deskripsi,
            'tanggal_masuk'  => now(),
        ]);

        return response()->json(['message' => 'Barang masuk berhasil dicatat', 'id' => $id], 201);
    }
}
