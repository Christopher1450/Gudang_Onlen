<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'activity',
        'description'
    ];
    // public $incrementing = false;

    // protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
