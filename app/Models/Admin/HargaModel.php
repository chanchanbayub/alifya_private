<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class HargaModel extends Model
{
    protected $table            = 'harga_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['peserta_didik_id', 'jenis_media_id', 'harga', 'bulan', 'media_belajar', 'faktur'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getHarga()
    {
        return $this->table($this->table)
            ->select('harga_table.id, harga_table.peserta_didik_id, harga_table.bulan ,harga_table.harga,harga_table.faktur, harga_table.media_belajar, data_murid_table.nama_lengkap_anak, jenis_media_table.nama_media')
            ->join('data_murid_table', 'data_murid_table.id = harga_table.peserta_didik_id')
            ->join('jenis_media_table', 'jenis_media_table.id = harga_table.jenis_media_id', 'left')
            ->orderBy('id desc')->get()->getResultObject();
    }

    public function getHargaPerbulan($peserta_didik_id)
    {
        return $this->table($this->table)
            ->select('harga_table.id, harga_table.peserta_didik_id, harga_table.harga, harga_table.media_belajar ,data_murid_table.nama_lengkap_anak')
            ->join('data_murid_table', 'data_murid_table.id = harga_table.peserta_didik_id')
            ->where(["peserta_didik_id" => $peserta_didik_id])
            ->orderBy('id desc')->get()->getRowObject();
    }
}
