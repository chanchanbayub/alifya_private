<?php

namespace App\Models\Mitra;

use CodeIgniter\Model;

class MateriBelajarModel extends Model
{
    protected $table            = 'materi_belajar_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['program_belajar_id', 'level'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getMateriBelajar()
    {
        return $this->table($this->table)
            ->select("materi_belajar_table.id, materi_belajar_table.level, materi_belajar_table.program_belajar_id, program_belajar_table.nama_program, program_belajar_table.usia_anak")
            ->join('program_belajar_table', 'program_belajar_table.id = materi_belajar_table.program_belajar_id', 'left')
            ->orderBy('materi_belajar_table.id desc')
            ->get()->getResultObject();
    }
}
