<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\RoleManagementModel;
use App\Models\Admin\UserManagementModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserManagementController extends BaseController
{
    protected $userManagementModel;
    protected $pengajarModel;
    protected $roleManagementModel;
    protected $validation;


    public function __construct()
    {
        $this->userManagementModel = new UserManagementModel();
        $this->pengajarModel = new PengajarModel();
        $this->roleManagementModel = new RoleManagementModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'User Management',
            'user_management' => $this->userManagementModel->getUserManagement(),
            'mitra_pengajar' => $this->pengajarModel->getDataPengajarStatusAktif(),
            'role_management' => $this->roleManagementModel->getRoleManagement()
        ];

        return view('admin/user_management_v', $data);
    }

    public function getMitra()
    {
        if ($this->request->isAJAX()) {

            $mitra_pengajar_id = $this->request->getVar('mitra_pengajar_id');

            $mitra_pengajar = $this->pengajarModel->where(["id" => $mitra_pengajar_id])->get()->getRowObject();

            $data = [
                'mitra_pengajar' => $mitra_pengajar
            ];

            return json_encode($data);
        }
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !'
                    ]
                ],

                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Email Tidak Boleh Kosong !'
                    ]
                ],

                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password Tidak Boleh Kosong !'
                    ]
                ],

                'role_management_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role Management Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'email' => $this->validation->getError('email'),
                        'password' => $this->validation->getError('password'),
                        'role_management_id' => $this->validation->getError('role_management_id'),
                    ]
                ];
            } else {

                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $role_management_id = $this->request->getPost('role_management_id');

                $this->userManagementModel->save([
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'email' => strtolower($email),
                    'password' => strtolower($password),
                    'role_management_id' => strtolower($role_management_id),
                ]);

                $alert = [
                    'success' => 'User Management Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $user_management = $this->userManagementModel->where(["id" => $id])->first();

            $mitra_pengajar = $this->pengajarModel->getDataPengajarStatusAktif();

            $data = [
                'user_management' => $user_management,
                'mitra_pengajar' => $mitra_pengajar
            ];

            return json_encode($data);
        }
    }



    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $user_management = $this->userManagementModel->where(["id" => $id])->first();

            $this->userManagementModel->delete($user_management["id"]);

            $alert = [
                'success' => 'User Management Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }
}
