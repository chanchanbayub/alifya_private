<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class JadwalTetapModel extends Model
{
    protected $table            = 'jadwal_tetap_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['hari_id', 'mitra_pengajar_id', 'peserta_didik_id', 'jam_belajar'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getJadwal()
    {
        return $this->table($this->table)
            ->select("jadwal_tetap_table.id,jadwal_tetap_table.hari_id, jadwal_tetap_table.mitra_pengajar_id, jadwal_tetap_table.peserta_didik_id, jadwal_tetap_table.jam_belajar, data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak, data_murid_table.status_murid_id ,hari_belajar_table.nama_hari, status_murid_table.status_murid")
            ->join('hari_belajar_table', 'hari_belajar_table.id = jadwal_tetap_table.hari_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = jadwal_tetap_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = jadwal_tetap_table.peserta_didik_id')
            ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->where(["data_murid_table.status_murid_id" => 1])
            ->orderBy('jadwal_tetap_table.id desc')
            ->get()->getResultObject();
    }

    public function getJadwalHarian($hari)
    {
        return $this->table($this->table)
            ->select("jadwal_tetap_table.id,jadwal_tetap_table.hari_id, jadwal_tetap_table.mitra_pengajar_id, jadwal_tetap_table.peserta_didik_id, jadwal_tetap_table.jam_belajar, data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak, hari_belajar_table.nama_hari")
            ->join('hari_belajar_table', 'hari_belajar_table.id = jadwal_tetap_table.hari_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = jadwal_tetap_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = jadwal_tetap_table.peserta_didik_id')
            ->where(["hari_belajar_table.nama_hari" => $hari])
            ->orderBy('jadwal_tetap_table.id desc')
            ->get()->getResultObject();
    }

    public function getJadwalbulanan($mitra_pengajar_id)
    {
        return $this->table($this->table)
            ->select("jadwal_tetap_table.id,jadwal_tetap_table.hari_id, jadwal_tetap_table.mitra_pengajar_id, jadwal_tetap_table.peserta_didik_id, jadwal_tetap_table.jam_belajar, data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak, hari_belajar_table.nama_hari")
            ->join('hari_belajar_table', 'hari_belajar_table.id = jadwal_tetap_table.hari_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = jadwal_tetap_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = jadwal_tetap_table.peserta_didik_id')
            ->where(["jadwal_tetap_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->orderBy('jadwal_tetap_table.id desc')
            ->get()->getResultObject();
    }
}
