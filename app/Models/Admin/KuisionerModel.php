<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KuisionerModel extends Model
{
    protected $table            = 'kuisioner_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['pembimbing_id', 'mitra_pengajar_id', 'administrasi', 'bulan', 'tahun', 'jumlah_murid_aktif', 'kehadiran'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getKuisioner()
    {
        return $this->table($this->table)
            ->select('kuisioner_table.id, kuisioner_table.pembimbing_id, kuisioner_table.mitra_pengajar_id , bulan , tahun, data_pengajar_table.nama_lengkap, skala_nilai_table.bobot as administrasi, kuisioner_table.jumlah_murid_aktif,  kuisioner_table.kehadiran, skala_nilai_table.kategori_apr_id')
            ->join('data_pengajar_table ', 'data_pengajar_table.id = kuisioner_table.mitra_pengajar_id')
            // ->join('pembimbing_table', 'pembimbing_table.mitra_pengajar_id = data_pengajar_table.id')
            // ->join('data_pengajar_table as pm', 'pm.id = pembimbing_table.mitra_pengajar_id')
            ->join('skala_nilai_table', 'skala_nilai_table.id = kuisioner_table.administrasi')
            ->orderBy('data_pengajar_table.nama_lengkap asc')->get()->getResultObject();
    }

    public function cekDataKuisioner($pembimbing_id, $mitra_pengajar_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select('kuisioner_table.id, kuisioner_table.pembimbing_id, kuisioner_table.mitra_pengajar_id , bulan , tahun, data_pengajar_table.nama_lengkap, skala_nilai_table.bobot as administrasi, kuisioner_table.jumlah_murid_aktif, kuisioner_table.kehadiran')
            ->join('data_pengajar_table ', 'data_pengajar_table.id = kuisioner_table.mitra_pengajar_id')
            ->join('skala_nilai_table', 'skala_nilai_table.id = kuisioner_table.administrasi')
            ->where(["pembimbing_id" => $pembimbing_id])
            ->where(["mitra_pengajar_id" => $mitra_pengajar_id])
            ->where(["bulan" => $bulan])
            ->where(["tahun" => $tahun])
            ->orderBy('data_pengajar_table.nama_lengkap asc')->get()->getResultObject();
    }
    public function getRekapKuisionerPerbulan($bulan, $tahun)
    {
        return $this->table($this->table)
            ->select('kuisioner_table.id, kuisioner_table.pembimbing_id, kuisioner_table.mitra_pengajar_id , bulan , tahun, data_pengajar_table.nama_lengkap, skala_nilai_table.bobot as administrasi, kuisioner_table.jumlah_murid_aktif,  kuisioner_table.kehadiran, skala_nilai_table.kategori_apr_id')
            ->join('data_pengajar_table ', 'data_pengajar_table.id = kuisioner_table.mitra_pengajar_id')
            ->join('skala_nilai_table', 'skala_nilai_table.id = kuisioner_table.administrasi')
            ->where(["bulan" => $bulan])
            ->where(["tahun" => $tahun])
            ->orderBy('data_pengajar_table.nama_lengkap asc')->get()->getResultObject();
    }
}
