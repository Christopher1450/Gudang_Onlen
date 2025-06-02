<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LogActivity
{
    // public function handle(Request $request, Closure $next)
    public function handle($request, Closure $next)
    {
        // Jalankan request dulu
        // $response = $next($request);

        // Buat ID kustom (optional)
        // $logId = uniqid(prefix: 'LOG');

        if (Auth::check()) {
            ActivityLog::create([
                'id' => uniqid('LOG'),
                'user_id' => Auth::user()->user_id,
                'activitys' => $request->method().' '.$request->path(),
                'keterangan' => json_encode($request->all()),
            ]);
        }
        // ActivityLog::create([
        //     'id'        => $logId,
        //     'user_id'   => auth()->user()->user_id ?? 'unknown',
        //     'aktivitas' => $request->method() . ' ' . $request->path(),
        //     'keterangan' => 'Otomatis dicatat dari middleware',
        // ]);
        return $next($request);
            // return $response;

    }
}
