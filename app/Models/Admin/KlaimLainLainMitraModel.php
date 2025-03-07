<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KlaimLainLainMitraModel extends Model
{
    protected $table            = 'lain_lain_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_pengajar_id', 'bulan', 'tahun', 'lain_lain'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getLainLain()
    {
        $db = db_connect();
        $builder = $db->table($this->table);

        $builder = $builder->select('lain_lain_table.id, lain_lain_table.mitra_pengajar_id, lain_lain_table.bulan, lain_lain_table.lain_lain ,lain_lain_table.tahun, data_pengajar_table.nama_lengkap, status_pengajar_table.status_pengajar')
            ->join('data_pengajar_table', 'data_pengajar_table.id = lain_lain_table.mitra_pengajar_id')
            ->join('status_pengajar_table', 'status_pengajar_table.id = data_pengajar_table.status_id')
            ->where(["data_pengajar_table.status_id" => 1]);
        return $builder->orderBy('data_pengajar_table.nama_lengkap asc');
    }

    public function getLainLainPerbulanData($bulan, $tahun)
    {

        return $this->table($this->table)
            ->select('lain_lain_table.id, lain_lain_table.mitra_pengajar_id, lain_lain_table.bulan, lain_lain_table.lain_lain ,lain_lain_table.tahun, data_pengajar_table.nama_lengkap, status_pengajar_table.status_pengajar')
            ->join('data_pengajar_table', 'data_pengajar_table.id = lain_lain_table.mitra_pengajar_id')
            ->join('status_pengajar_table', 'status_pengajar_table.id = data_pengajar_table.status_id')
            ->where(['lain_lain_table.bulan' => $bulan])
            ->where(['lain_lain_table.tahun' => $tahun])
            ->where(["data_pengajar_table.status_id" => 1])
            ->orderBy('data_pengajar_table.nama_lengkap asc')->get()->getResultObject();
    }

    public function getLainLainPerbulanDataMitraPengajar($mitra_pengajar_id, $bulan, $tahun)
    {

        return $this->table($this->table)
            ->select('SUM(lain_lain_table.lain_lain) as total_lain_lain, lain_lain_table.id, lain_lain_table.mitra_pengajar_id, lain_lain_table.bulan, lain_lain_table.lain_lain ,lain_lain_table.tahun, data_pengajar_table.nama_lengkap, status_pengajar_table.status_pengajar')
            ->join('data_pengajar_table', 'data_pengajar_table.id = lain_lain_table.mitra_pengajar_id')
            ->join('status_pengajar_table', 'status_pengajar_table.id = data_pengajar_table.status_id')
            ->where(['lain_lain_table.mitra_pengajar_id' => $mitra_pengajar_id])
            ->where(['lain_lain_table.bulan' => $bulan])
            ->where(['lain_lain_table.tahun' => $tahun])
            ->where(["data_pengajar_table.status_id" => 1])
            ->orderBy('data_pengajar_table.nama_lengkap asc')->get()->getRowObject();
    }
}
