<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index() {
        return Item::with(['category', 'subcategory', 'supplier'])->get();
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'kode_item'         => 'required|unique:items,kode_item',
        'nama_item'         => 'required|string|max:255',
        'category_id'       => 'required|exists:category,id',
        'subcategory_name'  => 'nullable|exists:subcategory,name',
        'supplier_name'     => 'required|exists:suppliers,name',
        'stok'              => 'required|integer|min:0',
        'harga'             => 'required|numeric|min:0',
        'warna'             => 'required|string|max:50',
        'size'              => 'required|string|max:10',
    ]);

    $item = Item::create($validated);

    return response()->json([
        'message'   => 'Item created successfully.',
        'data'      => $item
    ], 201);
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_item' => 'sometimes|string|max:255',
            'stok' => 'sometimes|integer|min:0',
            'harga' => 'sometimes|numeric|min:0',
        ]);

        $item = Item::findOrFail($id);
        $item->update($validated);

        return response()->json([
            'message' => 'Item updated successfully.',
            'data' => $item
        ]);
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item deleted successfully.']);
    }
}
