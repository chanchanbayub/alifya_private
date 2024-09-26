<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KelompokModel extends Model
{
    protected $table            = 'kelompok_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['kelompok', 'mitra_pengajar_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getKelompokPengajar()
    {
        return $this->table($this->table)
            ->select("kelompok_table.id, kelompok_table.kelompok, kelompok_table.mitra_pengajar_id, data_pengajar_table.nama_lengkap")
            ->join('data_pengajar_table', 'data_pengajar_table.id = kelompok_table.mitra_pengajar_id')
            ->orderBy('kelompok_table.id desc')
            ->get()->getResultObject();
    }

    public function getKelompokWithId($id)
    {
        return $this->table($this->table)
            ->select("kelompok_table.id, kelompok_table.kelompok, kelompok_table.mitra_pengajar_id, data_pengajar_table.nama_lengkap,data_pengajar_table.foto, status_pengajar_table.status_pengajar")
            ->join('data_pengajar_table', 'data_pengajar_table.id = kelompok_table.mitra_pengajar_id')
            ->join('status_pengajar_table', 'status_pengajar_table.id = data_pengajar_table.status_id')
            ->where(["kelompok_table.id" => $id])
            ->orderBy('kelompok_table.id desc')
            ->get()->getRowObject();
    }
}
