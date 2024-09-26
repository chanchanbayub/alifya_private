<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\StatusMuridModel;
use CodeIgniter\HTTP\ResponseInterface;

class StatusMuridController extends BaseController
{
    protected $statusMuridModel;
    protected $validation;

    public function __construct()
    {
        $this->statusMuridModel = new StatusMuridModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Status Peserta Didik',
            'status_murid' => $this->statusMuridModel->getStatusMurid()
        ];

        return view('admin/status_murid_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'status_murid' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Murid Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'status_murid' => $this->validation->getError('status_murid'),

                    ]
                ];
            } else {

                $status_murid = $this->request->getPost('status_murid');

                $this->statusMuridModel->save([
                    'status_murid' => strtolower($status_murid),

                ]);

                $alert = [
                    'success' => 'Status Murid Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $Materi = $this->statusMuridModel->where(["id" => $id])->first();

            return json_encode($Materi);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $Materi = $this->statusMuridModel->where(["id" => $id])->first();

            $this->statusMuridModel->delete($Materi["id"]);

            $alert = [
                'success' => 'Status Murid Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'status_murid' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'status_murid Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'status_murid' => $this->validation->getError('status_murid'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $status_murid = $this->request->getPost('status_murid');


                $this->statusMuridModel->update($id, [
                    'status_murid' => strtolower($status_murid),

                ]);

                $alert = [
                    'success' => 'Status Murid Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
