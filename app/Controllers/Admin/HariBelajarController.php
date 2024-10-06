<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HariBelajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class HariBelajarController extends BaseController
{
    protected $hariBelajarModel;
    protected $validation;

    public function __construct()
    {
        $this->hariBelajarModel = new HariBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Hari Belajar',
            'hari_belajar' => $this->hariBelajarModel->getHari()
        ];

        return view('admin/hari_belajar_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_hari' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Hari Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_hari' => $this->validation->getError('nama_hari'),

                    ]
                ];
            } else {

                $nama_hari = $this->request->getPost('nama_hari');

                $this->hariBelajarModel->save([
                    'nama_hari' => strtolower($nama_hari),

                ]);

                $alert = [
                    'success' => 'Hari Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $Materi = $this->hariBelajarModel->where(["id" => $id])->first();

            return json_encode($Materi);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $Materi = $this->hariBelajarModel->where(["id" => $id])->first();

            $this->hariBelajarModel->delete($Materi["id"]);

            $alert = [
                'success' => 'Hari Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_hari' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nama_hari Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_hari' => $this->validation->getError('nama_hari'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $nama_hari = $this->request->getPost('nama_hari');


                $this->hariBelajarModel->update($id, [
                    'nama_hari' => strtolower($nama_hari),

                ]);

                $alert = [
                    'success' => 'Hari Berhasil di Update !'
                ];
            }

            return json_encode($alert);
        }
    }
}
