<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    protected $table            = 'lokasi_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['lokasi'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getLokasi()
    {
        return $this->table($this->table)
            ->select("*")
            ->orderBy('lokasi_table.id desc')
            ->get()->getResultObject();
    }
}
