<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Exports\ActivityLogsExport;
use Maatwebsite\Excel\Facades\Excel;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        if ($request->filled('nama_id')) {
            $query->where('nama_id', $request->nama_id);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $logs = $query->paginate(10);
        return view('activity.index', compact('logs'));
    }

    public function export(Request $request)
    {
        $nama_id = $request->nama_id;
        $tanggal = $request->tanggal;
        $format  = $request->format ?? 'xlsx'; // default ke Excel

        $fileName = 'log_aktivitas.' . $format;

        $exportType = $format === 'csv' ? \Maatwebsite\Excel\Excel::CSV : \Maatwebsite\Excel\Excel::XLSX;

        return Excel::download(new ActivityLogsExport($nama_id, $tanggal), $fileName, $exportType);
    }
}