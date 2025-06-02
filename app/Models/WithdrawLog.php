<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class WithdrawLog extends Model
{
    use LogsActivity;

    protected $fillable = [
        'kode_item',
        'nama_item',
        'warna',
        'size',
        'user_id',
        'nama_pengambil',
        'quantity',
        'tanggal_pengambilan',
        'deskripsi',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'kode_item',
                'nama_item',
                'warna',
                'size',
                'user_id',
                'nama_pengambil',
                'quantity',
                'tanggal_pengambilan'
            ])
            ->useLogName('withdraw_log')
            ->logOnlyDirty();
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'kode_item', 'kode_item');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
