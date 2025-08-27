<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class LayananAHLModel extends Model
{
    protected $table            = 'layanan_ahl_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_layanan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getLayananAhl()
    {
        return $this->table($this->table)
            ->select("*")
            ->orderBy('layanan_ahl_table.id desc')
            ->get()->getResultObject();
    }
}
