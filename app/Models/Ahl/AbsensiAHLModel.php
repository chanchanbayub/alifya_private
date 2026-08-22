<?php

namespace App\Models\AHL;

use CodeIgniter\Model;

class AbsensiAHLModel extends Model
{
    protected $table            = 'absensi_ahl_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['tanggal', 'mitra_pengajar_id', 'keterangan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAbsensiAhl()
    {
        return $this->table($this->table)
            ->select('absensi_ahl_table.id,absensi_ahl_table.tanggal, absensi_ahl_table.mitra_pengajar_id, absensi_ahl_table.keterangan')
            ->join('data_pengajar_table', 'data_pengajar_table.id = absensi_ahl_table.mitra_pengajar_id')
            ->orderBy('absensi_ahl_table.tanggal desc')->get()->getResultObject();
    }

    public function getAbsensiMitraAhl()
    {
        $db = db_connect();
        $builder = $db->table($this->table);

        $builder = $builder->select('absensi_ahl_table.id,absensi_ahl_table.tanggal, absensi_ahl_table.mitra_pengajar_id, data_pengajar_table.nama_lengkap, absensi_ahl_table.keterangan')
            ->join('data_pengajar_table', 'data_pengajar_table.id = absensi_ahl_table.mitra_pengajar_id');
        return $builder->orderBy('absensi_ahl_table.tanggal desc');
    }

    public function getDataAbsensiAhl($id)
    {
        return $this->table($this->table)
            ->select('absensi_ahl_table.id,absensi_ahl_table.tanggal, absensi_ahl_table.mitra_pengajar_id, absensi_ahl_table.keterangan')
            ->join('data_pengajar_table', 'data_pengajar_table.id = absensi_ahl_table.mitra_pengajar_id')
            ->where(["absensi_ahl_table.id" => $id])
            ->orderBy('id desc')->get()->getRowObject();
    }
}
