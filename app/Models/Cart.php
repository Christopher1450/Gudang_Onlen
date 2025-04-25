<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'nama_id', 'kode_item', 'nama_item',
        'warna', 'size', 'jumlah', 'deskripsi', 'gambar'
    ];
}

