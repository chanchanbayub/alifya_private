<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KategoriAPRModel;
use CodeIgniter\HTTP\ResponseInterface;

class KategoriAPRController extends BaseController
{
    protected $kategoriAPRModel;
    protected $validation;

    public function __construct()
    {
        $this->kategoriAPRModel = new KategoriAPRModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Kategori Alifya Performance Rangking',
            'kategori' => $this->kategoriAPRModel->getKategori()
        ];

        return view('admin/kategori_apr_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_kategori_apr' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'bobot_nilai_apr' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_kategori_apr' => $this->validation->getError('nama_kategori_apr'),
                        'bobot_nilai_apr' => $this->validation->getError('bobot_nilai_apr'),

                    ]
                ];
            } else {

                $nama_kategori_apr = $this->request->getPost('nama_kategori_apr');
                $bobot_nilai_apr = $this->request->getPost('bobot_nilai_apr');

                $this->kategoriAPRModel->save([
                    'nama_kategori_apr' => strtolower($nama_kategori_apr),
                    'bobot_nilai_apr' => strtolower($bobot_nilai_apr),

                ]);

                $alert = [
                    'success' => 'Kategori APR Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kategori_apr = $this->kategoriAPRModel->where(["id" => $id])->first();

            return json_encode($kategori_apr);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kategori_apr = $this->kategoriAPRModel->where(["id" => $id])->first();

            $this->kategoriAPRModel->delete($kategori_apr["id"]);

            $alert = [
                'success' => 'Kategori Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_kategori_apr' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'bobot_nilai_apr' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_kategori_apr' => $this->validation->getError('nama_kategori_apr'),
                        'bobot_nilai_apr' => $this->validation->getError('bobot_nilai_apr'),

                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $nama_kategori_apr = $this->request->getPost('nama_kategori_apr');
                $bobot_nilai_apr = $this->request->getPost('bobot_nilai_apr');

                $this->kategoriAPRModel->update($id, [
                    'nama_kategori_apr' => strtolower($nama_kategori_apr),
                    'bobot_nilai_apr' => strtolower($bobot_nilai_apr),

                ]);

                $alert = [
                    'success' => 'Kategori APR Berhasil di Ubah!'
                ];
            }

            return json_encode($alert);
        }
    }
}
