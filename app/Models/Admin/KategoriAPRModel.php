<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KategoriAPRModel extends Model
{
    protected $table            = 'kategori_apr_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_kategori_apr', 'bobot_nilai_apr'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // public function getHarga()
    // {
    //     $db = db_connect();
    //     $builder = $db->table($this->table);

    //     $builder = $builder->select('harga_table.id, harga_table.peserta_didik_id, harga_table.bulan ,harga_table.harga, harga_table.tahun ,data_murid_table.nama_lengkap_anak, data_murid_table.status_murid_id, status_murid_table.status_murid')
    //         ->join('data_murid_table', 'data_murid_table.id = harga_table.peserta_didik_id')
    //         ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
    //         ->where(["data_murid_table.status_murid_id" => 1]);
    //     return $builder->orderBy('data_murid_table.nama_lengkap_anak asc');
    // }

    public function getKategori()
    {
        return $this->table($this->table)
            ->select('kategori_apr_table.id, kategori_apr_table.nama_kategori_apr, kategori_apr_table.bobot_nilai_apr')
            ->orderBy('id desc')
            ->get()
            ->getResultObject();
    }
}
