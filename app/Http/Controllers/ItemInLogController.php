<?php

namespace App\Http\Controllers;

use App\Models\ItemInLog;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ItemInLogController extends Controller
{
    public function index()
    {
        return ItemInLog::with('item')->latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_item'     => 'required|exists:items,kode_item',
            'quantity'        => 'required|integer|min:1',
            'supplier_id'   => 'required|exists:suppliers,id',
            'deskripsi'     => 'nullable|string',
            'tanggal_masuk' => 'required|date',
        ]);

        // $supplier = Supplier::where('name', $request->supplier_name)->firstOrFail();

        return ItemInLog::create([
            'id'            => uniqid('IN'),
            'kode_item'     => $request->kode_item,
            'quantity'      => $request->quantity,
            'supplier_id'   => $request->supplier_id,
            'deskripsi'     => $request->deskripsi,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);
    }

    public function update(Request $request, ItemInLog $itemInLog)
    {
        $request->validate([
            'kode_item'     => 'required|exists:items,kode_item',
            'quantity'      => 'required|integer|min:1',
            'supplier_id'   => 'required|exists:suppliers,id',
            'deskripsi'     => 'nullable|string',
            'tanggal_masuk' => 'required|date',
        ]);

        $itemInLog->update($request->all());
        return $itemInLog;
    }

    public function destroy(ItemInLog $itemInLog)
    {
        $itemInLog->delete();
        return response()->json(['message' => 'Item log deleted.']);
    }
}
