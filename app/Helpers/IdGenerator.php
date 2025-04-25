<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class IdGenerator
{
    public static function generateId($prefix, $table)
    {
        $last = DB::table($table)
            ->where('id', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if (!$last) {
            return $prefix . '001';
        }

        $lastNumber = (int) substr($last->id, strlen($prefix));
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        return $prefix . $newNumber;
    }
}
