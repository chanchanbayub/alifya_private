<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class UpahMitraModel extends Model
{
    protected $table            = 'upah_mitra_ahl_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_ahl_id', 'bulan', 'upah_mitra', 'lain_lain'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUpahMitraAhl()
    {
        return $this->table($this->table)
            ->select("upah_mitra_ahl_table.id, upah_mitra_ahl_table.mitra_ahl_id, upah_mitra_ahl_table.bulan, upah_mitra_ahl_table.upah_mitra, upah_mitra_ahl_table.lain_lain, data_pengajar_table.nama_lengkap")
            ->join('mitra_pengajar_ahl_table', 'mitra_pengajar_ahl_table.mitra_id = upah_mitra_ahl_table.mitra_ahl_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = mitra_pengajar_ahl_table.mitra_id')
            ->orderBy('upah_mitra_ahl_table.id desc')
            ->get()->getResultObject();
    }

    public function getUpahMitra()
    {
        $db = db_connect();
        $builder = $db->table($this->table);

        $builder = $builder->select('upah_mitra_ahl_table.id, upah_mitra_ahl_table.mitra_ahl_id, upah_mitra_ahl_table.bulan, upah_mitra_ahl_table.upah_mitra, upah_mitra_ahl_table.lain_lain, data_pengajar_table.nama_lengkap')
            ->join('mitra_pengajar_ahl_table', 'mitra_pengajar_ahl_table.mitra_id = upah_mitra_ahl_table.mitra_ahl_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = mitra_pengajar_ahl_table.mitra_id');
        return $builder->orderBy('data_pengajar_table.nama_lengkap asc');
    }
}
