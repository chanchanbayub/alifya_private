<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\StatusPengajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class StatusPengajarController extends BaseController
{
    protected $statusPengajarModel;
    protected $validation;

    public function __construct()
    {
        $this->statusPengajarModel = new StatusPengajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Status Pengajar',
            'status_pengajar' => $this->statusPengajarModel->getStatusPengajar()
        ];

        return view('admin/status_pengajar_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'status_pengajar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Pengajar Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'status_pengajar' => $this->validation->getError('status_pengajar'),

                    ]
                ];
            } else {

                $status_pengajar = $this->request->getPost('status_pengajar');

                $this->statusPengajarModel->save([
                    'status_pengajar' => strtolower($status_pengajar),

                ]);

                $alert = [
                    'success' => 'Status Pengajar Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $Materi = $this->statusPengajarModel->where(["id" => $id])->first();

            return json_encode($Materi);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $Materi = $this->statusPengajarModel->where(["id" => $id])->first();

            $this->statusPengajarModel->delete($Materi["id"]);

            $alert = [
                'success' => 'Status Pengajar Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'status_pengajar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'status_pengajar Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'status_pengajar' => $this->validation->getError('status_pengajar'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $status_pengajar = $this->request->getPost('status_pengajar');


                $this->statusPengajarModel->update($id, [
                    'status_pengajar' => strtolower($status_pengajar),

                ]);

                $alert = [
                    'success' => 'Status Pengajar Berhasil di Update !'
                ];
            }

            return json_encode($alert);
        }
    }
}
