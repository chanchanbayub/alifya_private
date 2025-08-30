<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\StatusPresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class StatusPresensiController extends BaseController
{
    protected $statusPresensiModel;
    protected $validation;

    public function __construct()
    {
        $this->statusPresensiModel = new StatusPresensiModel();
        $this->validation = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'title' => 'Status Presensi',
            'status_presensi' => $this->statusPresensiModel->getStatusPresensi()
        ];

        return view('ahl/status_presensi_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'status_presensi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Presensi Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'status_presensi' => $this->validation->getError('status_presensi'),

                    ]
                ];
            } else {

                $status_presensi = $this->request->getPost('status_presensi');

                $this->statusPresensiModel->save([
                    'status_presensi' => strtolower($status_presensi),

                ]);

                $alert = [
                    'success' => 'Status Presensi Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $status_presensi = $this->statusPresensiModel->where(["id" => $id])->first();

            return json_encode($status_presensi);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $status_presensi = $this->statusPresensiModel->where(["id" => $id])->first();

            $this->statusPresensiModel->delete($status_presensi["id"]);

            $alert = [
                'success' => 'Status Presensi Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'status_presensi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'status_presensi Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'status_presensi' => $this->validation->getError('status_presensi'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $status_presensi = $this->request->getPost('status_presensi');

                $this->statusPresensiModel->update($id, [
                    'status_presensi' => strtolower($status_presensi),

                ]);

                $alert = [
                    'success' => 'Status Presensi Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
