<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'alamat',
        'contact'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
