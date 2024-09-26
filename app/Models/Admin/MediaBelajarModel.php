<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class MediaBelajarModel extends Model
{
    protected $table            = 'media_belajar_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_pengajar_id', 'bulan_media', 'harga_media'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getMediaBelajar($mitra_pengajar_id, $bulan_media)
    {
        return $this->table($this->table)
            ->select("media_belajar_table.id, media_belajar_table.bulan_media, media_belajar_table.mitra_pengajar_id, media_belajar_table.harga_media ,data_pengajar_table.nama_lengkap")
            ->join('data_pengajar_table', 'data_pengajar_table.id = media_belajar_table.mitra_pengajar_id')
            ->where(["media_belajar_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where(["media_belajar_table.bulan_media" => $bulan_media])
            ->orderBy('media_belajar_table.id desc')
            ->get()->getRowObject();
    }
}
