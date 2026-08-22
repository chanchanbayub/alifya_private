<?php

namespace App\Models\Mitra;

use CodeIgniter\Model;

class AbsensiAHLModel extends Model
{
    protected $table            = 'absensi_ahl_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['tanggal', 'mitra_pengajar_id', 'peserta_didik_ahl_id', 'absen', 'keterangan', 'pergantian_jadwal'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDataAbsensiAhl($mitra_pengajar)
    {
        return $this->table($this->table)
            ->select('absensi_ahl_table.id,absensi_ahl_table.tanggal, absensi_ahl_table.mitra_pengajar_id, absensi_ahl_table.peserta_didik_ahl_id, absensi_ahl_table.absen, absensi_ahl_table.keterangan ,peserta_didik_ahl_table.nama_lengkap_anak, data_pengajar_table.nama_lengkap, ')
            ->join('data_pengajar_table', 'data_pengajar_table.id = absensi_ahl_table.mitra_pengajar_id')
            ->join('peserta_didik_ahl_table', 'peserta_didik_ahl_table.id = absensi_ahl_table.peserta_didik_ahl_id')
            ->join('status_murid_table', 'status_murid_table.id = peserta_didik_ahl_table.status_peserta_id')
            ->where(["absensi_ahl_table.mitra_pengajar_id" => $mitra_pengajar])
            ->where(["peserta_didik_ahl_table.status_peserta_id" => 1])
            ->orderBy('id desc')->get()->getResultObject();
    }

    // public function getDataAbsensiWhereId($id)
    // {
    //     return $this->table($this->table)
    //         ->select('absensi_table.id,absensi_table.tanggal, absensi_table.mitra_pengajar_id, absensi_table.peserta_didik_id, absensi_table.absen, absensi_table.keterangan ,data_murid_table.nama_lengkap_anak, data_pengajar_table.nama_lengkap, ')
    //         ->join('data_pengajar_table', 'data_pengajar_table.id = absensi_table.mitra_pengajar_id')
    //         ->join('data_murid_table', 'data_murid_table.id = absensi_table.peserta_didik_id')
    //         ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
    //         ->where(["absensi_table.id" => $id])
    //         ->where(["data_murid_table.status_murid_id" => 1])
    //         ->orderBy('id desc')->get()->getRowObject();
    // }
}
