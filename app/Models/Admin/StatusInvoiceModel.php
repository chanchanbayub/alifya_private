<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class StatusInvoiceModel extends Model
{
    protected $table            = 'status_invoice_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['status_invoice'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getStatusInvoice()
    {
        return $this->table($this->table)
            ->orderBy('id desc')
            ->get()->getResultObject();
    }
}
