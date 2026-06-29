<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class SkalaNilaiAPRModel extends Model
{
    protected $table            = 'skala_nilai_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['kategori_apr_id', 'nilai', 'bobot', 'keterangan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getSkalaNilai()
    {
        return $this->table($this->table)
            ->select('skala_nilai_table.id, skala_nilai_table.kategori_apr_id, skala_nilai_table.nilai, skala_nilai_table.bobot, skala_nilai_table.keterangan, kategori_apr_table.nama_kategori_apr')
            ->join('kategori_apr_table', 'kategori_apr_table.id = skala_nilai_table.kategori_apr_id')
            ->orderBy('skala_nilai_table.id asc')
            ->get()->getResultObject();
    }
}
