<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemInLog extends Model
{
    protected $table = 'item_in_logs';

    protected $fillable = [
        'id',
        'kode_item',
        'jumlah',
        'supplier_id',
        'deskripsi',
        'tanggal_masuk',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'kode_item', 'kode_item');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
