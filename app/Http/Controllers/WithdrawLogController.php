<?php

namespace App\Http\Controllers;

use App\Models\WithdrawLog;
use Illuminate\Http\Request;

class WithdrawLogController extends Controller
{
    public function index()
    {
        return WithdrawLog::with(['item', 'user'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'               => 'required|exists:users,user_id',
            'nama_item'             => 'required|exists:items,nama_item',
            'quantity'              => 'required|integer|min:1',
            'tanggal_pengambilan'   => 'required|date',
            'deskripsi'             => 'nullable|string',
        ]);

        $item = \App\Models\Item::where('nama_item', $request->nama_item)->firstOrFail();

        $log = WithdrawLog::create([
            'kode_item'             => $item->kode_item,
            'nama_item'             => $item->nama_item,
            'warna'                 => $item->warna,
            'size'                  => $item->size,
            'user_id'               => $request->user_id,
            'quantity'              => $request->quantity,
            'tanggal_pengambilan'   => $request->tanggal_pengambilan,
            'deskripsi'             => $request->deskripsi,
            'nama_pengambil'        => \Illuminate\Support\Facades\Auth::user()->name ?? 'unknown'
        ]);

        return response()->json([
            'message' => 'WithdrawLog created successfully.',
            'data'    => $log
        ], 201);
    }

    public function show($id)
    {
        return WithdrawLog::with(['item', 'user'])->findOrFail($id);
    }

    public function destroy($id)
    {
        $withdrawLog = WithdrawLog::findOrFail($id);
        $withdrawLog->delete();

        return response()->json(['message' => 'Withdraw log deleted successfully']);
    }
}
