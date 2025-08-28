<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class JenisPekerjaanModel extends Model
{
    protected $table            = 'jenis_pekerjaan_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['jenis_pekerjaan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getJenisPekerjaan()
    {
        return $this->table($this->table)
            ->select("*")
            ->orderBy('jenis_pekerjaan_table.id desc')
            ->get()->getResultObject();
    }
}
