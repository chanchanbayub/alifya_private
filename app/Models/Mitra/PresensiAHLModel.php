<?php

namespace App\Models\Mitra;

use CodeIgniter\Model;

class PresensiAHLModel extends Model
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

    public function getPresensiAhlByid($mitra_id)
    {
        return $this->table($this->table)
            ->select("presensi_ahl_table.id, presensi_ahl_table.tanggal, presensi_ahl_table.jam, presensi_ahl_table.lain_lain ,presensi_ahl_table.keterangan, presensi_ahl_table.dokumentasi, data_pengajar_table.nama_lengkap, lokasi_table.lokasi, jenis_pekerjaan_table.jenis_pekerjaan, status_presensi_table.status_presensi")
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_ahl_table.mitra_id')
            ->join('jenis_pekerjaan_table', 'jenis_pekerjaan_table.id = presensi_ahl_table.jenis_pekerjaan_id')
            ->join('lokasi_table', 'lokasi_table.id = presensi_ahl_table.lokasi_id')
            ->join('status_presensi_table', 'status_presensi_table.id = presensi_ahl_table.status_presensi_id')
            ->where(["presensi_ahl_table.mitra_id" => $mitra_id])
            ->orderBy('presensi_ahl_table.id desc')
            ->get()->getResultObject();
    }
}
