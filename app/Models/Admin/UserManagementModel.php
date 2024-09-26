<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UserManagementModel extends Model
{
    protected $table            = 'users_management_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_pengajar_id', 'email', 'password', 'role_management_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUserManagement()
    {
        return $this->table($this->table)
            ->select('users_management_table.id, users_management_table.mitra_pengajar_id, users_management_table.email,users_management_table.password, users_management_table.role_management_id, data_pengajar_table.nama_lengkap, role_management_table.role_management')
            ->join('data_pengajar_table', 'data_pengajar_table.id = users_management_table.mitra_pengajar_id')
            ->join('role_management_table', 'role_management_table.id = users_management_table.role_management_id')
            ->orderBy('id desc')
            ->get()->getResultObject();
    }

    public function getUserManagementData($email, $password)
    {
        return $this->table($this->table)
            ->select('users_management_table.id, users_management_table.mitra_pengajar_id, users_management_table.email,users_management_table.password, users_management_table.role_management_id, data_pengajar_table.nama_lengkap, data_pengajar_table.foto, role_management_table.role_management')
            ->join('data_pengajar_table', 'data_pengajar_table.id = users_management_table.mitra_pengajar_id')
            ->join('role_management_table', 'role_management_table.id = users_management_table.role_management_id')
            ->where(["users_management_table.email" => $email])
            ->where(["users_management_table.password" => $password])
            ->orderBy('users_management_table.id desc')
            ->get()->getRowObject();
    }
}
