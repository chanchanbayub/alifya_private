<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AlatPengajaranModel extends Model
{
    protected $table            = 'alat_pengajaran_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['materi_belajar', 'link'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAlatPengajaran()
    {
        return $this->table($this->table)
            ->select("alat_pengajaran_table.id, alat_pengajaran_table.materi_belajar, alat_pengajaran_table.link")
            ->orderBy('alat_pengajaran_table.id desc')
            ->get()->getResultObject();
    }
}
