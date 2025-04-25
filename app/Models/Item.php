<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $primaryKey = 'kode_item';
    public $incrementing = false; // Karena string, bukan auto increment
    protected $keyType = 'string';

    protected $fillable = [
        'kode_item', 'nama_item', 'kategori_id', 'subkategori_id', 'warna', 'size', 'stok', 'minimum_stok'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subkategori_id');
    }
}
