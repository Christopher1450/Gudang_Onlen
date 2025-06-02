<?php

namespace App\Exports;

use App\Models\ActivityLog;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivityLogsExport implements FromQuery, WithHeadings
{
    protected $nama_id;
    protected $tanggal;

    public function __construct($nama_id = null, $tanggal = null)
    {
        $this->nama_id = $nama_id;
        $this->tanggal = $tanggal;
    }

    public function query()
    {
        $query = ActivityLog::query();

        if ($this->nama_id) {
            $query->where('nama_id', $this->nama_id);
        }

        if ($this->tanggal) {
            $query->whereDate('created_at', $this->tanggal);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama ID',
            'Activity',
            'Keterangan',
            'Tanggal dan Jam',
        ];
    }
}
