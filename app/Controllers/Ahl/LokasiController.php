<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\LokasiModel;
use CodeIgniter\HTTP\ResponseInterface;

class LokasiController extends BaseController
{
    protected $lokasiModel;
    protected $validation;

    public function __construct()
    {
        $this->lokasiModel = new LokasiModel();
        $this->validation = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'title' => 'Lokasi Presensi',
            'lokasi' => $this->lokasiModel->getLokasi()
        ];

        return view('ahl/lokasi_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'lokasi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'lokasi' => $this->validation->getError('lokasi'),

                    ]
                ];
            } else {

                $lokasi = $this->request->getPost('lokasi');

                $this->lokasiModel->save([
                    'lokasi' => strtolower($lokasi),

                ]);

                $alert = [
                    'success' => 'Lokasi Presensi Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $lokasi = $this->lokasiModel->where(["id" => $id])->first();

            return json_encode($lokasi);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $lokasi = $this->lokasiModel->where(["id" => $id])->first();

            $this->lokasiModel->delete($lokasi["id"]);

            $alert = [
                'success' => 'Lokasi Presensi Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'lokasi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'lokasi Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'lokasi' => $this->validation->getError('lokasi'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $lokasi = $this->request->getPost('lokasi');

                $this->lokasiModel->update($id, [
                    'lokasi' => strtolower($lokasi),

                ]);

                $alert = [
                    'success' => 'Lokasi Presensi Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
