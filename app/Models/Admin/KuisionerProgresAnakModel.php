<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KuisionerProgresAnakModel extends Model
{
    protected $table            = 'kuisioner_progres_anak_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['pembimbing_id', 'mitra_pengajar_id', 'peserta_didik_id', 'bulan', 'tahun', 'progres_anak'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getKuisioner()
    {
        return $this->table($this->table)
            ->select('kuisioner_progres_anak_table.id, kuisioner_progres_anak_table.pembimbing_id, kuisioner_progres_anak_table.mitra_pengajar_id, kuisioner_progres_anak_table.peserta_didik_id, bulan , tahun, data_pengajar_table.nama_lengkap, skala_nilai_table.kategori_apr_id, skala_nilai_table.bobot,data_murid_table.nama_lengkap_anak')
            ->join('data_pengajar_table ', 'data_pengajar_table.id = kuisioner_progres_anak_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = kuisioner_progres_anak_table.peserta_didik_id')
            // ->join('pembimbing_table', 'pembimbing_table.mitra_pengajar_id = data_pengajar_table.id')
            // ->join('data_pengajar_table as pm', 'pm.id = pembimbing_table.mitra_pengajar_id')
            ->join('skala_nilai_table', 'skala_nilai_table.id = kuisioner_progres_anak_table.progres_anak')
            ->orderBy('data_pengajar_table.nama_lengkap asc')->get()->getResultObject();
    }

    public function cekDataKuisioner($pembimbing_id, $mitra_pengajar_id, $peserta_didik_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select('kuisioner_progres_anak_table.id, kuisioner_progres_anak_table.pembimbing_id, kuisioner_progres_anak_table.mitra_pengajar_id, kuisioner_progres_anak_table.peserta_didik_id, bulan , tahun, data_pengajar_table.nama_lengkap, skala_nilai_table.kategori_apr_id, skala_nilai_table.bobot,data_murid_table.nama_lengkap_anak')
            ->join('data_pengajar_table ', 'data_pengajar_table.id = kuisioner_progres_anak_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = kuisioner_progres_anak_table.peserta_didik_id')
            ->join('skala_nilai_table', 'skala_nilai_table.id = kuisioner_progres_anak_table.progres_anak')
            ->where(["pembimbing_id" => $pembimbing_id])
            ->where(["mitra_pengajar_id" => $mitra_pengajar_id])
            ->where(["peserta_didik_id" => $peserta_didik_id])
            ->where(["bulan" => $bulan])
            ->where(["tahun" => $tahun])
            ->orderBy('data_pengajar_table.nama_lengkap asc')->get()->getResultObject();
    }

    public function getRataRata($pembimbing_id, $mitra_pengajar_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select('SUM(skala_nilai_table.bobot) as total_bobot, kuisioner_progres_anak_table.id, kuisioner_progres_anak_table.pembimbing_id, kuisioner_progres_anak_table.mitra_pengajar_id, kuisioner_progres_anak_table.peserta_didik_id, bulan , tahun, data_pengajar_table.nama_lengkap, skala_nilai_table.kategori_apr_id, skala_nilai_table.bobot,data_murid_table.nama_lengkap_anak')
            ->join('data_pengajar_table ', 'data_pengajar_table.id = kuisioner_progres_anak_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = kuisioner_progres_anak_table.peserta_didik_id')
            ->join('skala_nilai_table', 'skala_nilai_table.id = kuisioner_progres_anak_table.progres_anak')
            ->where(["pembimbing_id" => $pembimbing_id])
            ->where(["mitra_pengajar_id" => $mitra_pengajar_id])

            ->where(["bulan" => $bulan])
            ->where(["tahun" => $tahun])
            ->orderBy('data_pengajar_table.nama_lengkap asc')->get()->getRowObject();
    }

    public function getJumlahData($pembimbing_id, $mitra_pengajar_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select('kuisioner_progres_anak_table.id, kuisioner_progres_anak_table.pembimbing_id, kuisioner_progres_anak_table.mitra_pengajar_id, kuisioner_progres_anak_table.peserta_didik_id, bulan , tahun, data_pengajar_table.nama_lengkap, skala_nilai_table.kategori_apr_id, skala_nilai_table.bobot,data_murid_table.nama_lengkap_anak')
            ->join('data_pengajar_table ', 'data_pengajar_table.id = kuisioner_progres_anak_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = kuisioner_progres_anak_table.peserta_didik_id')
            ->join('skala_nilai_table', 'skala_nilai_table.id = kuisioner_progres_anak_table.progres_anak')
            ->where(["pembimbing_id" => $pembimbing_id])
            ->where(["mitra_pengajar_id" => $mitra_pengajar_id])
            ->where(["bulan" => $bulan])
            ->where(["tahun" => $tahun])
            ->orderBy('data_pengajar_table.nama_lengkap asc')->get()->getResultObject();
    }
}
