<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\User;
use App\Models\ItemInLog;
use App\Models\WithdrawLog;
use Carbon\CarbonPeriod;


class DashboardController extends Controller
{
    public function index()
    {
        $period = CarbonPeriod::create(now()->subDays(6), now());
        $labels = [];
        $masuk = [];
        $keluar = [];

        foreach ($period as $date) {
            $labels[] = $date->format('d M');
            $masuk[] = ItemInLog::whereDate('tanggal_masuk', $date)->sum('jumlah');
            $keluar[] = WithdrawLog::whereDate('tanggal_pengambilan', $date)->sum('jumlah');
        }

        return view('dashboard', [
            'total_items' => Item::count(),
            'order_today' => Order::whereDate('created_at', now())->count(),
            'invoice_count' => Invoice::count(),
            'user_count' => User::count(),
            'low_stock_items' => Item::whereColumn('stok', '<=', 'minimum_stok')->get(),

            // Chart
            'chart_labels' => $labels,
            'chart_in' => $masuk,
            'chart_out' => $keluar,
        ]);
    }
}
