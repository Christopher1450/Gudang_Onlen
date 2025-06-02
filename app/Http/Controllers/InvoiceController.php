<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        return Invoice::with('user')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'tanggal' => 'required|date',
            'jumlah_item' => 'required|integer|min:1',
            'total_pembayaran' => 'required|numeric|min:0',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        $data = Invoice::create($validated);

        return response()->json(['message' => 'Invoice created successfully.', 'data' => $data], 201);
    }

    public function show($id)
    {
        return response()->json(Invoice::findOrFail($id));
    }

    public function destroy($id)
    {
        Invoice::findOrFail($id)->delete();
        return response()->json(['message' => 'Invoice deleted successfully.']);
    }
}
