<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class PriceListModel extends Model
{
    protected $table            = 'price_list_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['program_belajar_ahl_id', 'nama_paket', 'jumlah_pertemuan', 'harga_paket'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPriceListAhl()
    {
        $db = db_connect();
        $builder = $db->table($this->table);

        $builder = $builder->select('price_list_table.id, price_list_table.program_belajar_ahl_id, price_list_table.nama_paket, price_list_table.jumlah_pertemuan, price_list_table.harga_paket, program_ahl_table.nama_program')
            ->join('program_ahl_table', 'program_ahl_table.id = price_list_table.program_belajar_ahl_id');
        return $builder->orderBy('price_list_table.id asc');
    }

    public function getPriceList()
    {
        return $this->table($this->table)
            ->select("price_list_table.id, price_list_table.program_belajar_ahl_id, price_list_table.nama_paket, price_list_table.jumlah_pertemuan, price_list_table.harga_paket, program_ahl_table.nama_program")
            ->join('program_ahl_table', 'program_ahl_table.id = price_list_table.program_belajar_ahl_id')
            ->orderBy('price_list_table.id desc')
            ->get()->getResultObject();
    }
}
