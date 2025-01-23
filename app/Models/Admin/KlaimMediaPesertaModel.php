<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KlaimMediaPesertaModel extends Model
{
    protected $table            = 'media_belajar_anak_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['peserta_didik_id', 'bulan', 'tahun', 'jenis_media_id', 'harga_media', 'lain_lain', 'faktur'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getMediaBelajarAnak()
    {
        $db = db_connect();
        $builder = $db->table($this->table);

        $builder = $builder->select('*');
        return $builder->orderBy('data_murid_table.nama_lengkap_anak asc');
    }

    public function getHargaMedia()
    {
        $db = db_connect();
        $builder = $db->table($this->table);

        $builder = $builder->select('media_belajar_anak_table.id, media_belajar_anak_table.peserta_didik_id, media_belajar_anak_table.bulan, media_belajar_anak_table.tahun ,media_belajar_anak_table.harga_media, media_belajar_anak_table.lain_lain, media_belajar_anak_table.faktur  ,data_murid_table.nama_lengkap_anak, jenis_media_table.nama_media')
            ->join('data_murid_table', 'data_murid_table.id = media_belajar_anak_table.peserta_didik_id')
            ->join('jenis_media_table', 'jenis_media_table.id = media_belajar_anak_table.jenis_media_id');
        return $builder->orderBy('data_murid_table.nama_lengkap_anak asc');
    }

    public function getHargaPerbulan($peserta_didik_id)
    {

        $db = db_connect();
        $builder = $db->table($this->table);

        $builder = $builder->select('harga_table.id, harga_table.peserta_didik_id, harga_table.harga, harga_table.media_belajar ,data_murid_table.nama_lengkap_anak')
            ->join('data_murid_table', 'data_murid_table.id = harga_table.peserta_didik_id')
            ->where(["peserta_didik_id" => $peserta_didik_id]);
        return $builder->orderBy('id desc')->get()->getRowObject();
    }

    public function getHargaData()
    {

        return $this->table($this->table)
            ->select('harga_table.id, harga_table.peserta_didik_id, harga_table.bulan ,harga_table.harga,harga_table.faktur, harga_table.media_belajar, data_murid_table.nama_lengkap_anak, jenis_media_table.nama_media')
            ->join('data_murid_table', 'data_murid_table.id = harga_table.peserta_didik_id')
            ->join('jenis_media_table', 'jenis_media_table.id = harga_table.jenis_media_id', 'left')
            ->orderBy('id desc')->get()->getResultObject();
    }

    public function SumHargaMedia($bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("SUM(media_belajar_anak_table.harga_media) as total_harga_media")
            ->select("SUM(media_belajar_anak_table.lain_lain) as total_lain_lain")
            ->where(['media_belajar_anak_table.bulan' => $bulan])
            ->where(['media_belajar_anak_table.tahun' => $tahun])
            ->get()->getRowObject();
    }
}
