<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KelompokBelajarModel extends Model
{
    protected $table            = 'kelompok_belajar_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['kelompok_id',  'peserta_didik_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getKelompokBelajar()
    {
        return $this->table($this->table)
            ->select("kelompok_belajar_table.id, kelompok_belajar_table.kelompok_id, kelompok_table.kelompok, data_murid_table.nama_lengkap_anak, kelompok_belajar_table.peserta_didik_id, kelompok_table.mitra_pengajar_id, data_pengajar_table.nama_lengkap")
            ->join('kelompok_table', 'kelompok_table.id = kelompok_belajar_table.kelompok_id')
            ->join('data_murid_table', 'data_murid_table.id = kelompok_belajar_table.peserta_didik_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = kelompok_table.mitra_pengajar_id')
            ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->where(["data_murid_table.status_murid_id" => 1])
            ->orderBy('kelompok_table.kelompok asc')
            ->get()->getResultObject();
    }

    public function getUserWithKelompok($kelompok_id)
    {
        return $this->table($this->table)
            ->select("kelompok_belajar_table.id, kelompok_belajar_table.kelompok_id, kelompok_belajar_table.peserta_didik_id ,data_murid_table.nama_lengkap_anak, status_murid_table.status_murid")
            ->join('data_murid_table', 'data_murid_table.id = kelompok_belajar_table.peserta_didik_id')
            ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->where(["kelompok_belajar_table.kelompok_id" => $kelompok_id])
            ->where(["data_murid_table.status_murid_id" => 1])
            ->orderBy('kelompok_belajar_table.id desc')
            ->get()->getResultObject();
    }

    public function getPesertaDidikWhereMitraPengajar($mitra_pengajar_id)
    {
        return $this->table($this->table)
            ->select("kelompok_belajar_table.id, kelompok_belajar_table.kelompok_id, kelompok_belajar_table.peserta_didik_id, kelompok_table.mitra_pengajar_id, data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak")
            ->join('kelompok_table', 'kelompok_table.id = kelompok_belajar_table.kelompok_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = kelompok_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = kelompok_belajar_table.peserta_didik_id')
            // ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->where(["kelompok_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->orderBy('kelompok_belajar_table.id desc')
            ->get()->getResultObject();
    }

    public function getPesertaDidikWhereMitraPengajarSumPaketBelajar($mitra_pengajar_id)
    {
        return $this->table($this->table)
            ->select('sum(paket_belajar_table.jumlah_pertemuan) as total_paket_belajar')
            // ->select('data_murid_table.nama_lengkap_anak, paket_belajar_table.jumlah_pertemuan')
            ->join('kelompok_table', 'kelompok_table.id = kelompok_belajar_table.kelompok_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = kelompok_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = kelompok_belajar_table.peserta_didik_id')
            ->join('paket_belajar_table', 'paket_belajar_table.id = data_murid_table.paket_belajar_id')
            ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->where(["kelompok_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where(["data_murid_table.status_murid_id" => 1])
            ->orderBy('kelompok_belajar_table.id desc')
            ->get()->getRowObject();
    }


    public function sumTotalAnak()
    {
        return $this->table($this->table)
            ->select("COUNT(kelompok_belajar_table.peserta_didik_id) as total_anak")
            ->join('kelompok_table', 'kelompok_table.id = kelompok_belajar_table.kelompok_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = kelompok_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = kelompok_belajar_table.peserta_didik_id')
            // ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->orderBy('kelompok_belajar_table.id desc')
            ->get()->getRowObject();
    }
}
