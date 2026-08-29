<?php

namespace App\Models\Mitra;

use CodeIgniter\Model;

class KuisionerKreativitasModel extends Model
{
    protected $table            = 'kuisioner_kreativitas_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['pembimbing_id', 'mitra_pengajar_id', 'kreativitas', 'bulan', 'tahun'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getKuisionerKreativitas($pembimbing_id, $mitra_pengajar_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select('kuisioner_kreativitas_table.id , pembimbing_id, bulan, tahun, data_pengajar_table.nama_lengkap, skala_nilai_table.bobot as kreativitas')
            ->join('data_pengajar_table ', 'data_pengajar_table.id = kuisioner_kreativitas_table.mitra_pengajar_id')
            ->join('skala_nilai_table', 'skala_nilai_table.id = kuisioner_kreativitas_table.kreativitas')
            ->where(["pembimbing_id" => $pembimbing_id])
            ->where(["mitra_pengajar_id" => $mitra_pengajar_id])
            ->where(["bulan" => $bulan])
            ->where(["tahun" => $tahun])
            ->orderBy('id desc')->get()->getRowObject();
    }
}
