<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class HargaModel extends Model
{
    protected $table            = 'harga_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['peserta_didik_id', 'harga', 'bulan', 'tahun',];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getHarga()
    {
        $db = db_connect();
        $builder = $db->table($this->table);

        $builder = $builder->select('harga_table.id, harga_table.peserta_didik_id, harga_table.bulan ,harga_table.harga, harga_table.tahun ,data_murid_table.nama_lengkap_anak')
            ->join('data_murid_table', 'data_murid_table.id = harga_table.peserta_didik_id');
        return $builder->orderBy('data_murid_table.nama_lengkap_anak asc');
    }

    public function getHargaPerbulan($peserta_didik_id, $bulan, $tahun)
    {

        $db = db_connect();
        $builder = $db->table($this->table);

        $builder = $builder->select('harga_table.id, harga_table.peserta_didik_id, harga_table.bulan ,harga_table.harga, harga_table.tahun ,data_murid_table.nama_lengkap_anak, media_belajar_anak_table.harga_media, media_belajar_anak_table.lain_lain')
            ->join('data_murid_table', 'data_murid_table.id = harga_table.peserta_didik_id')
            ->join('media_belajar_anak_table', 'media_belajar_anak_table.peserta_didik_id = harga_table.peserta_didik_id')
            ->where(["harga_table.peserta_didik_id" => $peserta_didik_id])
            ->where(['harga_table.bulan' => $bulan])
            ->where(['harga_table.tahun' => $tahun]);
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

    public function getHargaPerbulanData($bulan, $tahun)
    {

        return $this->table($this->table)
            ->select('harga_table.id, harga_table.peserta_didik_id, harga_table.bulan ,harga_table.harga,  data_murid_table.nama_lengkap_anak, harga_table.tahun')
            ->join('data_murid_table', 'data_murid_table.id = harga_table.peserta_didik_id')
            ->where(['harga_table.bulan' => $bulan])
            ->where(['harga_table.tahun' => $tahun])
            ->orderBy('data_murid_table.nama_lengkap_anak asc')->get()->getResultObject();
    }

    public function getHargaPerbulanPeserta($peserta_didik_id, $bulan, $tahun)
    {

        return $this->table($this->table)

            ->select('harga_table.id, harga_table.peserta_didik_id, harga_table.bulan ,harga_table.harga, harga_table.tahun ,data_murid_table.nama_lengkap_anak, media_belajar_anak_table.harga_media, media_belajar_anak_table.lain_lain')
            ->join('data_murid_table', 'data_murid_table.id = harga_table.peserta_didik_id')
            ->join('media_belajar_anak_table', 'media_belajar_anak_table.peserta_didik_id = data_murid_table.id')
            ->where(["harga_table.peserta_didik_id" => $peserta_didik_id])
            ->where(['harga_table.bulan' => $bulan])
            ->where(['harga_table.tahun' => $tahun])
            ->where(['media_belajar_anak_table.bulan' => $bulan])
            ->where(['media_belajar_anak_table.tahun' => $tahun])
            ->orderBy('harga_table.id desc')->get()->getRowObject();
    }
}
