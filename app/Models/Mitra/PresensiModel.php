<?php

namespace App\Models\Mitra;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table            = 'presensi_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_pengajar_id', 'tanggal_masuk', 'jam_masuk', 'peserta_didik_id', 'dokumentasi', 'dokumentasi_orang_tua'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDataPresensi()
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.tanggal_masuk, presensi_table.jam_masuk, presensi_table.dokumentasi, data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak")
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->orderBy('presensi_table.tanggal_masuk desc')
            ->get()->getResultObject();
    }

    public function getPresensi($mitra_pengajar_id)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.tanggal_masuk, presensi_table.jam_masuk, presensi_table.dokumentasi, presensi_table.dokumentasi_orang_tua,  data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak")
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where(["data_murid_table.status_murid_id" => 1])
            ->orderBy('presensi_table.id desc')
            ->get()->getResultObject();
    }

    public function getPresensiWithMonth($mitra_pengajar_id, $bulan, $peserta_didik_id)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.mitra_pengajar_id ,presensi_table.tanggal_masuk, presensi_table.jam_masuk,  data_murid_table.nama_lengkap_anak")
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->where(["presensi_table.peserta_didik_id" => $peserta_didik_id])
            ->orderBy('presensi_table.tanggal_masuk desc')
            ->get()->getResultObject();
    }

    public function getPresensiMitraWithMonth($mitra_pengajar_id, $bulan)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.mitra_pengajar_id ,presensi_table.tanggal_masuk, presensi_table.jam_masuk,  data_murid_table.nama_lengkap_anak")
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->orderBy('presensi_table.tanggal_masuk desc')
            ->get()->getResultObject();
    }

    public function getDuplicatData($mitra_pengajar_id, $tanggal_masuk, $peserta_didik_id)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.tanggal_masuk, presensi_table.jam_masuk, presensi_table.dokumentasi, presensi_table.dokumentasi_orang_tua,  data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak")
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where(["presensi_table.tanggal_masuk" => $tanggal_masuk])
            ->where(["presensi_table.peserta_didik_id" => $peserta_didik_id])
            ->orderBy('presensi_table.id desc')
            ->get()->getRowObject();
    }

    public function getPresensiPerAnak($peserta_didik_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("COUNT(MONTH(presensi_table.tanggal_masuk)) as total_presensi_perbulan, data_murid_table.id,  data_murid_table.nama_lengkap_anak, paket_belajar_table.jumlah_pertemuan, data_pengajar_table.nama_lengkap, presensi_table.mitra_pengajar_id")
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id', 'left')
            ->join('paket_belajar_table', 'paket_belajar_table.id = data_murid_table.paket_belajar_id', 'left')
            ->where(["data_murid_table.id" => $peserta_didik_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->where('YEAR(presensi_table.tanggal_masuk)', $tahun)
            ->orderBy('data_pengajar_table.nama_lengkap desc')
            ->get()->getResultObject();
    }

    public function SumTotalAnak($mitra_pengajar_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("COUNT(MONTH(presensi_table.tanggal_masuk)) as total_presensi_perbulan, COUNT(DISTINCT(presensi_table.peserta_didik_id)) as total_anak")
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = kelompok_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->where('YEAR(presensi_table.tanggal_masuk)', $tahun)
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->orderBy('data_pengajar_table.nama_lengkap desc')
            ->get()->getRowObject();
    }
}
