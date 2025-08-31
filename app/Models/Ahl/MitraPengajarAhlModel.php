<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class MitraPengajarAhlModel extends Model
{
    protected $table            = 'mitra_pengajar_ahl_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_id', 'jenis_layanan_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getMitraPengajarAhl()
    {
        return $this->table($this->table)
            ->select("mitra_pengajar_ahl_table.id, mitra_pengajar_ahl_table.mitra_id, mitra_pengajar_ahl_table.jenis_layanan_id, data_pengajar_table.nama_lengkap, layanan_ahl_table.nama_layanan")
            ->join('data_pengajar_table', 'data_pengajar_table.id = mitra_pengajar_ahl_table.mitra_id')
            ->join('layanan_ahl_table', 'layanan_ahl_table.id = mitra_pengajar_ahl_table.jenis_layanan_id')
            ->orderBy('mitra_pengajar_ahl_table.id desc')
            ->get()->getResultObject();
    }

    public function getMitraPengajarAhlById($mitra_id)
    {
        return $this->table($this->table)
            ->select("mitra_pengajar_ahl_table.id, mitra_pengajar_ahl_table.mitra_id, mitra_pengajar_ahl_table.jenis_layanan_id, data_pengajar_table.nama_lengkap, layanan_ahl_table.nama_layanan")
            ->join('data_pengajar_table', 'data_pengajar_table.id = mitra_pengajar_ahl_table.mitra_id')
            ->join('layanan_ahl_table', 'layanan_ahl_table.id = mitra_pengajar_ahl_table.jenis_layanan_id')
            ->where(["mitra_pengajar_ahl_table.mitra_id" => $mitra_id])
            ->orderBy('mitra_pengajar_ahl_table.id desc')
            ->get()->getRowObject();
    }
}
