<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AlatTimModel extends Model
{
    protected $table            = 'alat_tim_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['keterangan', 'links'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAlatTim()
    {
        return $this->table($this->table)
            ->select("*")
            ->orderBy('alat_tim_table.id desc')
            ->get()->getResultObject();
    }
}
