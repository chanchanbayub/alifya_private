<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\RoleManagementModel;
use CodeIgniter\HTTP\ResponseInterface;

class RoleManagementController extends BaseController
{
    protected $roleManagementModel;
    protected $validation;

    public function __construct()
    {
        $this->roleManagementModel = new RoleManagementModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Role Management',
            'role_management' => $this->roleManagementModel->getRoleManagement()
        ];

        return view('admin/role_management_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'role_management' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role Management Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'role_management' => $this->validation->getError('role_management'),

                    ]
                ];
            } else {

                $role_management = $this->request->getPost('role_management');

                $this->roleManagementModel->save([
                    'role_management' => strtolower($role_management),

                ]);

                $alert = [
                    'success' => 'Role Management Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $Materi = $this->roleManagementModel->where(["id" => $id])->first();

            return json_encode($Materi);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $Materi = $this->roleManagementModel->where(["id" => $id])->first();

            $this->roleManagementModel->delete($Materi["id"]);

            $alert = [
                'success' => 'Role Management Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'role_management' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'role_management Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'role_management' => $this->validation->getError('role_management'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $role_management = $this->request->getPost('role_management');


                $this->roleManagementModel->update($id, [
                    'role_management' => strtolower($role_management),

                ]);

                $alert = [
                    'success' => 'Role Management Berhasil di Update !'
                ];
            }

            return json_encode($alert);
        }
    }
}
