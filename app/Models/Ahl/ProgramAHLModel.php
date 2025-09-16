<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class ProgramAHLModel extends Model
{
    protected $table            = 'program_ahl_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_program', 'usia_anak'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getProgramAHL()
    {
        return $this->table($this->table)
            ->select("*")
            ->orderBy('program_ahl_table.id desc')
            ->get()->getResultObject();
    }
}
