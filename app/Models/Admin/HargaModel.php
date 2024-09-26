<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class HargaModel extends Model
{
    protected $table            = 'harga_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['peserta_didik_id', 'bulan', 'harga'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getHarga()
    {
        return $this->table($this->table)
            ->select('harga_table.id, harga_table.peserta_didik_id, harga_table.harga, harga_table.bulan ,data_murid_table.nama_lengkap_anak')
            ->join('data_murid_table', 'data_murid_table.id = harga_table.peserta_didik_id')
            ->orderBy('id desc')->get()->getResultObject();
    }

    public function getHargaPerbulan($peserta_didik_id, $bulan)
    {
        return $this->table($this->table)
            ->select('harga_table.id, harga_table.peserta_didik_id, harga_table.harga, harga_table.bulan ,data_murid_table.nama_lengkap_anak')
            ->join('data_murid_table', 'data_murid_table.id = harga_table.peserta_didik_id')
            ->where(["peserta_didik_id" => $peserta_didik_id])
            ->where(["bulan" => $bulan])
            ->orderBy('id desc')->get()->getRowObject();
    }
}
