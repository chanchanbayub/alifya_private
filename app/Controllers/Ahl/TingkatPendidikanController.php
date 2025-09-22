<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\TinggalPendidikanModel;
use App\Models\Ahl\TingkatPendidikanModel;
use CodeIgniter\HTTP\ResponseInterface;

class TingkatPendidikanController extends BaseController
{
    protected $tingkatPendidikanModel;
    protected $validation;

    public function __construct()
    {
        $this->tingkatPendidikanModel = new TingkatPendidikanModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Tingkat Pendidikan',
            'pendidikan' => $this->tingkatPendidikanModel->getPendidikan()
        ];

        return view('ahl/tingkat_pendidikan_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'pendidikan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pendidikan Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'pendidikan' => $this->validation->getError('pendidikan'),

                    ]
                ];
            } else {

                $pendidikan = $this->request->getPost('pendidikan');

                $this->tingkatPendidikanModel->save([
                    'pendidikan' => strtolower($pendidikan),

                ]);

                $alert = [
                    'success' => 'Pendidikan Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $pendidikan = $this->tingkatPendidikanModel->where(["id" => $id])->first();

            return json_encode($pendidikan);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $pendidikan = $this->tingkatPendidikanModel->where(["id" => $id])->first();

            $this->tingkatPendidikanModel->delete($pendidikan["id"]);

            $alert = [
                'success' => 'Pendidikan Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'pendidikan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'pendidikan Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'pendidikan' => $this->validation->getError('pendidikan'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $pendidikan = $this->request->getPost('pendidikan');


                $this->tingkatPendidikanModel->update($id, [
                    'pendidikan' => strtolower($pendidikan),

                ]);

                $alert = [
                    'success' => 'Pendidikan Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
