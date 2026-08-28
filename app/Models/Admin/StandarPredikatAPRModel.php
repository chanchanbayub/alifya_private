<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class StandarPredikatAPRModel extends Model
{
    protected $table            = 'standar_predikat_apr_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['predikat', 'nilai_predikat'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getStandarPredikat()
    {
        return $this->table($this->table)
            ->select('standar_predikat_apr_table.id, standar_predikat_apr_table.predikat, standar_predikat_apr_table.nilai_predikat')
            ->orderBy('id desc')
            ->get()
            ->getResultObject();
    }
}
