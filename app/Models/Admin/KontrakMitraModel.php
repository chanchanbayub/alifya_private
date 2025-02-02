<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KontrakMitraModel extends Model
{
    protected $table            = 'kontrak_mitra_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_pengajar_id', 'awal_bergabung', 'akhir_kontrak'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getKontrakMitra()
    {
        return $this->table($this->table)
            ->select("kontrak_mitra_table.id,kontrak_mitra_table.mitra_pengajar_id,kontrak_mitra_table.awal_bergabung, kontrak_mitra_table.akhir_kontrak, data_pengajar_table.nama_lengkap")
            ->join('data_pengajar_table', 'data_pengajar_table.id = kontrak_mitra_table.mitra_pengajar_id')
            ->orderBy('kontrak_mitra_table.id desc')
            ->get()->getResultObject();
    }
}
