<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KontrakPesertaModel extends Model
{
    protected $table            = 'kontrak_peserta_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['peserta_didik_id', 'bulan_masuk'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function getKontrakPesertaDidik()
    {
        return $this->table($this->table)
            ->select('kontrak_peserta_table.id, data_murid_table.nama_lengkap_anak, kontrak_peserta_table.bulan_masuk, status_murid_table.status_murid, data_murid_table.status_murid_id')
            ->join('data_murid_table', 'data_murid_table.id = kontrak_peserta_table.peserta_didik_id')
            ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->orderBy('data_murid_table.nama_lengkap_anak asc')->get()->getResultObject();
    }
}
