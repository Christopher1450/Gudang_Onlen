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
            'kode_item'   => 'required|exists:items,kode_item',
            'jumlah'      => 'required|integer|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
            'deskripsi'   => 'nullable|string',
            'tanggal_masuk' => 'required|date',
        ]);

        ItemInLog::create([
            'id'            => uniqid('IN'), // ID format contoh IN654321
            'kode_item'     => $request->kode_item,
            'jumlah'        => $request->jumlah,
            'supplier_id'   => $request->supplier_id,
            'deskripsi'     => $request->deskripsi,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('items.index')->with('success', 'Barang masuk berhasil dicatat!');
    }
    public function edit(ItemInLog $itemInLog)
    {
        $items = Item::all();
        return view('items.edit', compact('itemInLog', 'items'));
    }
    public function update(Request $request, ItemInLog $itemInLog)
    {
        $request->validate([
            'kode_item'   => 'required|exists:items,kode_item',
            'jumlah'      => 'required|integer|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
            'deskripsi'   => 'nullable|string',
            'tanggal_masuk' => 'required|date',
        ]);

        $itemInLog->update([
            'kode_item'     => $request->kode_item,
            'jumlah'        => $request->jumlah,
            'supplier_id'   => $request->supplier_id,
            'deskripsi'     => $request->deskripsi,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('items.index')->with('success', 'Barang masuk berhasil diperbarui!');
    }
    public function destroy(ItemInLog $itemInLog)
    {
        $itemInLog->delete();
        return redirect()->route('items.index')->with('success', 'Barang masuk berhasil dihapus!');
    }
}
