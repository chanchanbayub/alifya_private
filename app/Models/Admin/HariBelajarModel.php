<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class HariBelajarModel extends Model
{
    protected $table            = 'hari_belajar_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_hari'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getHari()
    {
        return $this->table($this->table)
            ->orderBy('hari_belajar_table.id asc')
            ->get()->getResultObject();
    }
}
