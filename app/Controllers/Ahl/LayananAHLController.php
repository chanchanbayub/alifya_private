<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\LayananAHLModel;
use CodeIgniter\HTTP\ResponseInterface;

class LayananAHLController extends BaseController
{
    protected $layananAhlModel;
    protected $validation;

    public function __construct()
    {
        $this->layananAhlModel = new LayananAHLModel();
        $this->validation = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'title' => 'Layanan Aliya Home Learning',
            'layanan' => $this->layananAhlModel->getLayananAhl()
        ];

        return view('ahl/layanan_ahl_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_layanan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Layanan Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_layanan' => $this->validation->getError('nama_layanan'),

                    ]
                ];
            } else {

                $nama_layanan = $this->request->getPost('nama_layanan');

                $this->layananAhlModel->save([
                    'nama_layanan' => strtolower($nama_layanan),

                ]);

                $alert = [
                    'success' => 'Layanan Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $layanan = $this->layananAhlModel->where(["id" => $id])->first();

            return json_encode($layanan);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $layanan = $this->layananAhlModel->where(["id" => $id])->first();

            $this->layananAhlModel->delete($layanan["id"]);

            $alert = [
                'success' => 'Layanan AHL Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_layanan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nama_layanan Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_layanan' => $this->validation->getError('nama_layanan'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $nama_layanan = $this->request->getPost('nama_layanan');

                $this->layananAhlModel->update($id, [
                    'nama_layanan' => strtolower($nama_layanan),

                ]);

                $alert = [
                    'success' => 'Layanan AHL Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
