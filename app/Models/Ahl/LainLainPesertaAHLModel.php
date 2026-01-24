<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class LainLainPesertaAHLModel extends Model
{
    protected $table            = 'lain_lain_ahl_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['peserta_didik_ahl_id', 'bulan', 'tahun', 'lain_lain'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getLainLainAhl()
    {
        $db = db_connect();
        $builder = $db->table($this->table);

        $builder = $builder->select('lain_lain_ahl_table.id, lain_lain_ahl_table.peserta_didik_ahl_id, lain_lain_ahl_table.bulan, lain_lain_ahl_table.lain_lain,lain_lain_ahl_table.tahun, peserta_didik_ahl_table.nama_lengkap_anak')
            ->join('peserta_didik_ahl_table', 'peserta_didik_ahl_table.id = lain_lain_ahl_table.peserta_didik_ahl_id')
            ->join('status_murid_table', 'status_murid_table.id = peserta_didik_ahl_table.status_peserta_id')
            ->where(["peserta_didik_ahl_table.status_peserta_id" => 1]);
        return $builder->orderBy('peserta_didik_ahl_table.nama_lengkap_anak asc');
    }
}
