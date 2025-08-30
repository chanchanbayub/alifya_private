<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class JamMasukAhlModel extends Model
{
    protected $table            = 'jam_masuk_ahl_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['jenis_pekerjaan_id', 'jam_masuk_ahl', 'jam_pulang_ahl'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getJamMasukAHL()
    {
        return $this->table($this->table)
            ->select("jam_masuk_ahl_table.id, jam_masuk_ahl_table.jenis_pekerjaan_id, jam_masuk_ahl_table.jam_masuk_ahl, jam_masuk_ahl_table.jam_pulang_ahl, jenis_pekerjaan_table.jenis_pekerjaan")
            ->join('jenis_pekerjaan_table', 'jenis_pekerjaan_table.id = jam_masuk_ahl_table.jenis_pekerjaan_id')
            ->orderBy('jam_masuk_ahl_table.id desc')
            ->get()->getResultObject();
    }
}
