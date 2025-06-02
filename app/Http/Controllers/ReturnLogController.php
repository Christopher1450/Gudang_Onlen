<?php

namespace App\Http\Controllers;

use App\Models\ReturnLog;
use Illuminate\Http\Request;

class ReturnLogController extends Controller
{
    public function index() {
        return ReturnLog::with(['item', 'user'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'           => 'required|exists:users,user_id',
            'nama_item'         => 'required|exists:items,nama_item',
            'quantity'          => 'required|integer|min:1',
            'return_date'       => 'required|date',
            'condition_note'    => 'required|string'
        ]);

        $data = ReturnLog::create($validated);
        return response()->json(['message' => 'Return log created successfully.', 'data' => $data], 201);
    }

    public function show($id)
    {
        return response()->json(ReturnLog::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity'          => 'required|integer|min:1',
            'tanggal_kembali' => 'required|date',
        ]);

        $log = ReturnLog::findOrFail($id);
        $log->update($validated);

        return response()->json(['message' => 'Return log updated successfully.', 'data' => $log]);
    }

    public function destroy($id)
    {
        ReturnLog::findOrFail($id)->delete();
        return response()->json(['message' => 'Return log deleted successfully.']);
    }
    public function getReturnLogsByUser($userId)
    {
        $logs = ReturnLog::where('user_id', $userId)->with(['item'])->get();
        return response()->json($logs);
    }
}
