<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class PresensiAhlModel extends Model
{
    protected $table            = 'presensi_ahl_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_id', 'jenis_pekerjaan_id', 'tanggal', 'jam', 'lokasi_id', 'lain_lain', 'status_presensi_id', 'keterangan', 'dokumentasi'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPresensiAhl()
    {
        return $this->table($this->table)
            ->select("presensi_ahl_table.id, presensi_ahl_table.tanggal, presensi_ahl_table.jam, presensi_ahl_table.lain_lain ,presensi_ahl_table.keterangan, presensi_ahl_table.dokumentasi, data_pengajar_table.nama_lengkap, lokasi_table.lokasi, jenis_pekerjaan_table.jenis_pekerjaan, status_presensi_table.status_presensi")
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_ahl_table.mitra_id')
            ->join('jenis_pekerjaan_table', 'jenis_pekerjaan_table.id = presensi_ahl_table.jenis_pekerjaan_id')
            ->join('lokasi_table', 'lokasi_table.id = presensi_ahl_table.lokasi_id')
            ->join('status_presensi_table', 'status_presensi_table.id = presensi_ahl_table.status_presensi_id')
            ->orderBy('presensi_ahl_table.id desc')
            ->get()->getResultObject();
    }

    public function getPresensiWithMonthInvoice($mitra_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("COUNT(MONTH(presensi_ahl_table.tanggal)) as jumlah_presensi_perbulan, presensi_ahl_table.tanggal ,data_pengajar_table.id, data_pengajar_table.nama_lengkap, upah_mitra_ahl_table.upah_mitra, upah_mitra_ahl_table.lain_lain")
            ->join('mitra_pengajar_ahl_table', 'mitra_pengajar_ahl_table.mitra_id = presensi_ahl_table.mitra_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = mitra_pengajar_ahl_table.mitra_id')
            ->join('upah_mitra_ahl_table', 'upah_mitra_ahl_table.mitra_ahl_id = data_pengajar_table.id', 'left')
            ->join('status_presensi_table', 'status_presensi_table.id = presensi_ahl_table.status_presensi_id')
            ->where(["data_pengajar_table.id" => $mitra_id])
            ->where('MONTH(presensi_ahl_table.tanggal)', $bulan)
            ->where('YEAR(presensi_ahl_table.tanggal)', $tahun)
            ->where('MONTH(upah_mitra_ahl_table.bulan)', $bulan)
            ->where('YEAR(upah_mitra_ahl_table.bulan)', $tahun)
            ->orderBy('data_pengajar_table.nama_lengkap desc')
            ->get()->getResultObject();
    }

    public function getPresensiMasuk($mitra_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("COUNT(MONTH(presensi_ahl_table.tanggal)) as jumlah_presensi_masuk, presensi_ahl_table.tanggal, presensi_ahl_table.status_presensi_id,data_pengajar_table.id, data_pengajar_table.nama_lengkap, upah_mitra_ahl_table.upah_mitra, upah_mitra_ahl_table.lain_lain")
            ->join('mitra_pengajar_ahl_table', 'mitra_pengajar_ahl_table.mitra_id = presensi_ahl_table.mitra_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = mitra_pengajar_ahl_table.mitra_id')
            ->join('status_presensi_table', 'status_presensi_table.id = presensi_ahl_table.status_presensi_id')
            ->join('upah_mitra_ahl_table', 'upah_mitra_ahl_table.mitra_ahl_id = data_pengajar_table.id', 'left')
            ->where(["data_pengajar_table.id" => $mitra_id])
            ->where(["presensi_ahl_table.status_presensi_id" => 1])
            ->where('MONTH(presensi_ahl_table.tanggal)', $bulan)
            ->where('YEAR(presensi_ahl_table.tanggal)', $tahun)
            ->orderBy('data_pengajar_table.nama_lengkap desc')
            ->get()->getRowObject();
    }

    public function getPresensiPulang($mitra_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("COUNT(MONTH(presensi_ahl_table.tanggal)) as jumlah_presensi_pulang, presensi_ahl_table.tanggal, presensi_ahl_table.status_presensi_id,data_pengajar_table.id, data_pengajar_table.nama_lengkap, upah_mitra_ahl_table.upah_mitra, upah_mitra_ahl_table.lain_lain")
            ->join('mitra_pengajar_ahl_table', 'mitra_pengajar_ahl_table.mitra_id = presensi_ahl_table.mitra_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = mitra_pengajar_ahl_table.mitra_id')
            ->join('status_presensi_table', 'status_presensi_table.id = presensi_ahl_table.status_presensi_id')
            ->join('upah_mitra_ahl_table', 'upah_mitra_ahl_table.mitra_ahl_id = data_pengajar_table.id', 'left')
            ->where(["data_pengajar_table.id" => $mitra_id])
            ->where(["presensi_ahl_table.status_presensi_id" => 2])
            ->where('MONTH(presensi_ahl_table.tanggal)', $bulan)
            ->where('YEAR(presensi_ahl_table.tanggal)', $tahun)
            ->orderBy('data_pengajar_table.nama_lengkap desc')
            ->get()->getRowObject();
    }
    public function getPresensiDinasLuar($mitra_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("COUNT(MONTH(presensi_ahl_table.tanggal)) as jumlah_presensi_dinas_luar, presensi_ahl_table.tanggal, presensi_ahl_table.status_presensi_id,data_pengajar_table.id, data_pengajar_table.nama_lengkap, upah_mitra_ahl_table.upah_mitra, upah_mitra_ahl_table.lain_lain")
            ->join('mitra_pengajar_ahl_table', 'mitra_pengajar_ahl_table.mitra_id = presensi_ahl_table.mitra_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = mitra_pengajar_ahl_table.mitra_id')
            ->join('status_presensi_table', 'status_presensi_table.id = presensi_ahl_table.status_presensi_id')
            ->join('upah_mitra_ahl_table', 'upah_mitra_ahl_table.mitra_ahl_id = data_pengajar_table.id', 'left')
            ->where(["data_pengajar_table.id" => $mitra_id])
            ->where(["presensi_ahl_table.status_presensi_id" => 3])
            ->where('MONTH(presensi_ahl_table.tanggal)', $bulan)
            ->where('YEAR(presensi_ahl_table.tanggal)', $tahun)
            ->orderBy('data_pengajar_table.nama_lengkap desc')
            ->get()->getRowObject();
    }

    public function totalPresensiPerbulan($bulan, $tahun)
    {

        return $this->table($this->table)
            ->select("COUNT(MONTH(presensi_ahl_table.tanggal)) as total_presensi_perbulan")
            ->where('MONTH(presensi_ahl_table.tanggal)', $bulan)
            ->where('YEAR(presensi_ahl_table.tanggal)', $tahun)
            ->orderBy('presensi_ahl_table.id desc')
            ->get()->getRowObject();
    }
    public function totalPresensiPerbulanMasuk($bulan, $tahun)
    {

        return $this->table($this->table)
            ->select("COUNT(MONTH(presensi_ahl_table.tanggal)) as total_presensi_perbulan_masuk")
            ->where('MONTH(presensi_ahl_table.tanggal)', $bulan)
            ->where('YEAR(presensi_ahl_table.tanggal)', $tahun)
            ->where(["presensi_ahl_table.status_presensi_id" => 1])
            ->orderBy('presensi_ahl_table.id desc')
            ->get()->getRowObject();
    }
    public function totalPresensiPerbulanPulang($bulan, $tahun)
    {

        return $this->table($this->table)
            ->select("COUNT(MONTH(presensi_ahl_table.tanggal)) as total_presensi_perbulan_pulang")
            ->where('MONTH(presensi_ahl_table.tanggal)', $bulan)
            ->where('YEAR(presensi_ahl_table.tanggal)', $tahun)
            ->where(["presensi_ahl_table.status_presensi_id" => 2])
            ->orderBy('presensi_ahl_table.id desc')
            ->get()->getRowObject();
    }
    public function totalPresensiPerbulanDinasLuar($bulan, $tahun)
    {

        return $this->table($this->table)
            ->select("COUNT(MONTH(presensi_ahl_table.tanggal)) as total_presensi_perbulan_dinas_luar")
            ->where('MONTH(presensi_ahl_table.tanggal)', $bulan)
            ->where('YEAR(presensi_ahl_table.tanggal)', $tahun)
            ->where(["presensi_ahl_table.status_presensi_id" => 3])
            ->orderBy('presensi_ahl_table.id desc')
            ->get()->getRowObject();
    }

    public function getTotalUpah($bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("SUM(MONTH(upah_mitra_ahl_table.upah_mitra)) as total_upah_mitra")
            ->join('mitra_pengajar_ahl_table', 'mitra_pengajar_ahl_table.mitra_id = presensi_ahl_table.mitra_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = mitra_pengajar_ahl_table.mitra_id')
            ->join('upah_mitra_ahl_table', 'upah_mitra_ahl_table.mitra_ahl_id = data_pengajar_table.id', 'left')
            ->join('status_presensi_table', 'status_presensi_table.id = presensi_ahl_table.status_presensi_id')
            ->where('MONTH(upah_mitra_ahl_table.bulan)', $bulan)
            ->where('YEAR(upah_mitra_ahl_table.bulan)', $tahun)
            ->orderBy('data_pengajar_table.nama_lengkap desc')
            ->get()->getRowObject();
    }
}
