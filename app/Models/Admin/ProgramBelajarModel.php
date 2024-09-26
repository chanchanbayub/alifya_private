<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ProgramBelajarModel extends Model
{
    protected $table            = 'program_belajar_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_program', 'usia_anak', 'banner'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getProgramBelajar()
    {
        return $this->table($this->table)
            ->select("program_belajar_table.id, program_belajar_table.nama_program, program_belajar_table.usia_anak, program_belajar_table.banner")
            ->orderBy('program_belajar_table.id desc')
            ->get()->getResultObject();
    }
}
