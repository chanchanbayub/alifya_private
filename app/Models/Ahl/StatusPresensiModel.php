<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class StatusPresensiModel extends Model
{
    protected $table            = 'status_presensi_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['status_presensi'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getStatusPresensi()
    {
        return $this->table($this->table)
            ->select("*")
            ->orderBy('status_presensi_table.id desc')
            ->get()->getResultObject();
    }
}
