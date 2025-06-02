<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController
{
    public function index()
    {
        $logs = ActivityLog::with('user')->latest()->paginate(20);

        return response()->json([
            'message' => 'Activity logs retrieved successfully.',
            'data'    => $logs
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'   => 'required|exists:users,user_id',
            'activity' => 'required|string|max:255',
            'waktu'     => 'nullable|date',
        ]);

        $log = ActivityLog::create($validated);

        return response()->json([
            'message' => 'Activity log created successfully.',
            'data'    => $log
        ], 201);
    }
}
