<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemInLog extends Model
{
    protected $fillable = [
        'id',
        'kode_item',
        'quantity',
        'supplier_name',
        'supplier_id',
        'deskripsi',
        'tanggal_masuk'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function item()
    {
        return $this->belongsTo(Item::class, 'kode_item', 'kode_item');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
