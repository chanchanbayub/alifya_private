<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JenisMediaBelajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class JenisMediaBelajarController extends BaseController
{
    protected $jenisMediaBelajarModel;
    protected $validation;

    public function __construct()
    {
        $this->jenisMediaBelajarModel = new JenisMediaBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Jenis Media Belajar',
            'jenis_media_belajar' => $this->jenisMediaBelajarModel->getJenisMediaBelajar()
        ];

        return view('admin/jenis_media_belajar_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_media' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Media Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_media' => $this->validation->getError('nama_media'),
                    ]
                ];
            } else {

                $nama_media = $this->request->getPost('nama_media');

                $this->jenisMediaBelajarModel->save([
                    'nama_media' => strtolower($nama_media),
                ]);

                $alert = [
                    'success' => 'Media Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $jenis_media = $this->jenisMediaBelajarModel->where(["id" => $id])->first();

            return json_encode($jenis_media);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $jenis_media = $this->jenisMediaBelajarModel->where(["id" => $id])->first();

            $this->jenisMediaBelajarModel->delete($jenis_media["id"]);

            $alert = [
                'success' => 'Jenis Media Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_media' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nama_media Tidak Boleh Kosong !'
                    ]
                ],



            ])) {
                $alert = [
                    'error' => [
                        'nama_media' => $this->validation->getError('nama_media'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $nama_media = $this->request->getPost('nama_media');

                $this->jenisMediaBelajarModel->update($id, [
                    'nama_media' => strtolower($nama_media),

                ]);

                $alert = [
                    'success' => 'Jenis Media Berhasil di Update !'
                ];
            }

            return json_encode($alert);
        }
    }
}
