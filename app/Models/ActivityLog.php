<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'nama_id', 'aktivitas', 'keterangan'];

        public function user()
        {
            return $this->belongsTo(\App\Models\User::class, 'nama_id', 'nama_id');
        }
}
