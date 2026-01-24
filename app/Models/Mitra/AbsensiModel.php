<?php

namespace App\Models\Mitra;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table            = 'absensi_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['tanggal', 'mitra_pengajar_id', 'peserta_didik_id', 'absen', 'keterangan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDataAbsensi($mitra_pengajar)
    {
        return $this->table($this->table)
            ->select('absensi_table.id,absensi_table.tanggal, absensi_table.mitra_pengajar_id, absensi_table.peserta_didik_id, absensi_table.absen, absensi_table.keterangan ,data_murid_table.nama_lengkap_anak, data_pengajar_table.nama_lengkap, ')
            ->join('data_pengajar_table', 'data_pengajar_table.id = absensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = absensi_table.peserta_didik_id')
            ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->where(["absensi_table.mitra_pengajar_id" => $mitra_pengajar])
            ->where(["data_murid_table.status_murid_id" => 1])
            ->orderBy('id desc')->get()->getResultObject();
    }

    public function getDataAbsensiWhereId($id)
    {
        return $this->table($this->table)
            ->select('absensi_table.id,absensi_table.tanggal, absensi_table.mitra_pengajar_id, absensi_table.peserta_didik_id, absensi_table.absen, absensi_table.keterangan ,data_murid_table.nama_lengkap_anak, data_pengajar_table.nama_lengkap, ')
            ->join('data_pengajar_table', 'data_pengajar_table.id = absensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = absensi_table.peserta_didik_id')
            ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->where(["absensi_table.id" => $id])
            ->where(["data_murid_table.status_murid_id" => 1])
            ->orderBy('id desc')->get()->getRowObject();
    }
}
