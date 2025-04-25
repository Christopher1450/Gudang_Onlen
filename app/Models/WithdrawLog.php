<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawLog extends Model
{
    protected $table = 'withdraw_logs';

    protected $fillable = [
        'id',
        'kode_item',
        'jumlah',
        'user_id',
        'deskripsi',
        'tanggal_keluar',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'kode_item', 'kode_item');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
