<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Admin\UserManagementModel;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{

    protected $userManagementModel;
    protected $validation;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->userManagementModel = new UserManagementModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Login Page',

        ];
        return view('auth/login_v', $data);
    }

    public function cek_login()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email Tidak Boleh Kosong!',
                        'valid_email' => 'Email Tidak Valid!'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'email' => $this->validation->getError('email'),
                        'password' => $this->validation->getError('password'),
                    ]
                ];
            } else {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $user_mangement = $this->userManagementModel->getUserManagementData($email, $password);


                if ($user_mangement == null) {
                    $alert = [
                        'errors' => 'Username / Password Tidak ditemukan!'
                    ];
                } else {
                    if ($user_mangement->role_management_id == 1 || $user_mangement->role_management_id == 2) {
                        $data = [
                            'id' => $user_mangement->id,
                            'nama_lengkap' => $user_mangement->nama_lengkap,
                            'email' => $user_mangement->email,
                            'mitra_pengajar_id' => $user_mangement->mitra_pengajar_id,
                            'role_management' => $user_mangement->role_management,
                            'role_management_id' => $user_mangement->role_management_id,
                            'foto' => $user_mangement->foto,
                            'isLogedIn' => true
                        ];
                        session()->set($data);
                        $alert = [
                            'success' => 'Berhasil Login !',
                            'url' => '/admin/dashboard'
                        ];
                    } else if ($user_mangement->role_management_id == 3) {
                        $data = [
                            'id' => $user_mangement->id,
                            'nama_lengkap' => $user_mangement->nama_lengkap,
                            'email' => $user_mangement->email,
                            'mitra_pengajar_id' => $user_mangement->mitra_pengajar_id,
                            'role_management' => $user_mangement->role_management,
                            'role_management_id' => $user_mangement->role_management_id,
                            'foto' => $user_mangement->foto,
                            'isLogedIn' => true
                        ];
                        session()->set($data);
                        $alert = [
                            'success' => 'Berhasil Login !',
                            'url' => '/mitra_pengajar/dashboard'
                        ];
                    }
                }
            };
            return json_encode($alert);
        }
    }

    public function logout()
    {

        session()->destroy();

        return redirect()->to('/auth/login');
    }
}
