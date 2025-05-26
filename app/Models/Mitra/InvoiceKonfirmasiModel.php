<?php

namespace App\Models\Mitra;

use CodeIgniter\Model;

class InvoiceKonfirmasiModel extends Model
{
    protected $table            = 'konfirmasi_invoice_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_pengajar_id', 'peserta_didik_id', 'bulan_invoice', 'tahun_invoice', 'jumlah_kehadiran', 'status_invoice_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getMateriBelajar()
    {
        return $this->table($this->table)
            ->select("konfirmasi_invoice_table.id, konfirmasi_invoice_table.jumlah_kehadiran, konfirmasi_invoice_table.bulan_invoice, konfirmasi_invoice_table.tahun_invoice, data_pengajar_table.nama_lengkap, 'data_murid_table.nama_lengkap_anak, status_invoice_table.status_invoice")
            ->join('data_pengajar_table', 'data_pengajar_table.id = konfirmasi_invoice_table.mitra_pengajar_id', 'left')
            ->join('data_murid_table', 'data_murid_table.id = konfirmasi_invoice_table.peserta_didik_id', 'left')
            ->join('status_invoice_table', 'status_invoice_table.id = konfirmasi_invoice_table.status_invoice_id', 'left')
            ->orderBy('konfirmasi_invoice_table.id desc')
            ->get()->getResultObject();
    }
}
