<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnLog extends Model
{
    protected $fillable = [
        'nama_item',
        'user_id',
        'quantity',
        'return_date',
        'condition_note'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
