<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class HargaMitraModel extends Model
{
    protected $table            = 'harga_mitra_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_pengajar_id', 'peserta_didik_id', 'booster_media', 'harga_mitra'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getHargaMitra()
    {
        return $this->table($this->table)
            ->select('harga_mitra_table.id, harga_mitra_table.mitra_pengajar_id, harga_mitra_table.harga_mitra, harga_mitra_table.booster_media ,data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak')
            ->join('data_pengajar_table', 'data_pengajar_table.id = harga_mitra_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = harga_mitra_table.peserta_didik_id')
            ->orderBy('id desc')->get()->getResultObject();
    }

    public function getInvoice($mitra_pengajar_id)
    {
        return $this->table($this->table)
            ->select('harga_mitra_table.id, harga_mitra_table.mitra_pengajar_id, harga_mitra_table.harga_mitra, harga_mitra_table.booster_media, harga_mitra_table.booster_media, data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak')
            ->join('data_pengajar_table', 'data_pengajar_table.id = harga_mitra_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = harga_mitra_table.peserta_didik_id')
            ->where(["harga_mitra_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->orderBy('id desc')->get()->getRowObject();
    }

    public function getInvoiceData($mitra_pengajar_id)
    {
        return $this->table($this->table)
            ->select('harga_mitra_table.id, harga_mitra_table.mitra_pengajar_id, harga_mitra_table.harga_mitra, harga_mitra_table.booster_media, harga_mitra_table.booster_media, data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak')
            ->join('data_pengajar_table', 'data_pengajar_table.id = harga_mitra_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = harga_mitra_table.peserta_didik_id')
            ->where(["harga_mitra_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->orderBy('id desc')->get()->getResultObject();
    }

    public function getInvoiceWhereMitra($mitra_pengajar_id)
    {
        return $this->table($this->table)
            ->select('harga_mitra_table.id, harga_mitra_table.mitra_pengajar_id, harga_mitra_table.harga_mitra, harga_mitra_table.booster_media, harga_mitra_table.booster_media, data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak')
            ->join('data_pengajar_table', 'data_pengajar_table.id = harga_mitra_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = harga_mitra_table.peserta_didik_id')
            ->where(["harga_mitra_table.mitra_pengajar_id" => $mitra_pengajar_id])
            // ->where('MONTH(harga_mitra_table.bulan_mitra)', $bulan)
            ->orderBy('id desc')->get()->getRowObject();
    }
}
