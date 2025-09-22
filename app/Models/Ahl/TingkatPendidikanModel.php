<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class TingkatPendidikanModel extends Model
{
    protected $table            = 'tingkat_pendidikan_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['pendidikan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPendidikan()
    {
        return $this->table($this->table)
            ->orderBy('id asc')
            ->get()->getResultObject();
    }
}
