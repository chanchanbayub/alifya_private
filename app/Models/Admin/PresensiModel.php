<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table            = 'presensi_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_pengajar_id', 'tanggal_masuk', 'jam_masuk', 'peserta_didik_id', 'dokumentasi'];

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

    public function getDataPresensiPerhari($tanggal)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.tanggal_masuk, presensi_table.jam_masuk, presensi_table.dokumentasi, data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak, presensi_table.mitra_pengajar_id")
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->where(["presensi_table.tanggal_masuk" => $tanggal])
            ->orderBy('presensi_table.tanggal_masuk desc')
            ->get()->getResultObject();
    }

    public function getDataPresensiPerbulan($tanggal)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.tanggal_masuk, presensi_table.jam_masuk, presensi_table.dokumentasi, data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak")
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->where(["presensi_table.tanggal_masuk" => $tanggal])
            ->orderBy('presensi_table.tanggal_masuk desc')
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

            ->orderBy('presensi_table.tanggal_masuk desc')
            ->get()->getResultObject();
    }

    public function getInvoiceMitraWithMonth($mitra_pengajar_id, $bulan)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.mitra_pengajar_id ,presensi_table.tanggal_masuk, presensi_table.jam_masuk,  data_murid_table.nama_lengkap_anak, harga_mitra_table.harga_mitra, harga_mitra_table.booster_media")
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->join('harga_mitra_table', 'harga_mitra_table.peserta_didik_id = data_murid_table.id', 'left')
            // ->join('harga_mitra_table', 'presensi_table.mitra_pengajar_id = harga_mitra_table.mitra_pengajar_id ')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)

            ->orderBy('data_murid_table.nama_lengkap_anak asc')
            ->get()->getResultObject();
    }

    public function getInvoiceMitraWithMonthSum($mitra_pengajar_id, $bulan)
    {
        return $this->table($this->table)
            ->select('sum(harga_mitra_table.harga_mitra) as total')
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->join('harga_mitra_table', 'harga_mitra_table.peserta_didik_id = data_murid_table.id', 'left')
            // ->join('harga_mitra_table', 'presensi_table.mitra_pengajar_id = harga_mitra_table.mitra_pengajar_id ')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)

            ->orderBy('data_murid_table.nama_lengkap_anak asc')
            ->get()->getRowObject();
    }

    public function getMediaMitraWithMonthSum($mitra_pengajar_id, $bulan)
    {
        return $this->table($this->table)
            ->select('sum(harga_mitra_table.booster_media) as total_media')
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->join('harga_mitra_table', 'harga_mitra_table.peserta_didik_id = data_murid_table.id', 'left')
            // ->join('harga_mitra_table', 'presensi_table.mitra_pengajar_id = harga_mitra_table.mitra_pengajar_id ')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->orderBy('data_murid_table.nama_lengkap_anak asc')
            ->get()->getRowObject();
    }

    public function getPresensiPerMitra($mitra_pengajar_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.mitra_pengajar_id ,presensi_table.tanggal_masuk, presensi_table.jam_masuk,presensi_table.dokumentasi,data_murid_table.nama_lengkap_anak, data_pengajar_table.nama_lengkap")
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->where('YEAR(presensi_table.tanggal_masuk)', $tahun)

            ->orderBy('presensi_table.tanggal_masuk desc')
            ->get()->getResultObject();
    }
}
