<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class JenisMediaBelajarModel extends Model
{
    protected $table            = 'jenis_media_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_media'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getJenisMediaBelajar()
    {
        return $this->table($this->table)
            ->orderBy('id desc')
            ->get()->getResultObject();
    }
}
