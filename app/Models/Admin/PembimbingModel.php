<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PembimbingModel extends Model
{
    protected $table            = 'pembimbing_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_pengajar_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPembimbing()
    {
        return $this->table($this->table)
            ->select('pembimbing_table.id, data_pengajar_table.nama_lengkap, status_pengajar_table.status_pengajar')
            ->join('data_pengajar_table', 'data_pengajar_table.id = pembimbing_table.mitra_pengajar_id')
            ->join('status_pengajar_table', 'status_pengajar_table.id = data_pengajar_table.status_id')
            ->orderBy('data_pengajar_table.nama_lengkap asc')
            ->get()->getResultObject();
    }
}
