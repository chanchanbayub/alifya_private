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
        $db = db_connect();
        $builder = $db->table($this->table);

        $builder = $builder->select('kontrak_mitra_table.id, data_pengajar_table.nama_lengkap, kontrak_mitra_table.awal_bergabung, kontrak_mitra_table.akhir_kontrak')
            ->join('data_pengajar_table', 'data_pengajar_table.id = kontrak_mitra_table.mitra_pengajar_id');
        return $builder->orderBy('data_pengajar_table.nama_lengkap asc');
    }

    public function getKontrakMitraData()
    {
        return $this->table($this->table)
            ->select('kontrak_mitra_table.id, data_pengajar_table.nama_lengkap, kontrak_mitra_table.awal_bergabung, kontrak_mitra_table.akhir_kontrak, data_pengajar_table.status_id, data_pengajar_table.status_id, status_pengajar_table.status_pengajar')
            ->join('data_pengajar_table', 'data_pengajar_table.id = kontrak_mitra_table.mitra_pengajar_id')
            ->join('status_pengajar_table', 'status_pengajar_table.id = data_pengajar_table.status_id')
            ->where(['data_pengajar_table.status_id' => 1])
            ->orderBy('data_pengajar_table.nama_lengkap asc')
            ->get()->getResultObject();
    }

    public function getKontrakMitraPerbulan($bulan, $tahun)
    {
        return $this->table($this->table)
            ->select('kontrak_mitra_table.id, data_pengajar_table.nama_lengkap, kontrak_mitra_table.awal_bergabung, kontrak_mitra_table.akhir_kontrak')
            ->join('data_pengajar_table', 'data_pengajar_table.id = kontrak_mitra_table.mitra_pengajar_id')
            ->where('MONTH(kontrak_mitra_table.akhir_kontrak)', $bulan)
            ->where('YEAR(kontrak_mitra_table.akhir_kontrak)', $tahun)
            ->orderBy('data_pengajar_table.nama_lengkap asc')->get()->getResultObject();
    }
}
