<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HargaModel;
use App\Models\Admin\MuridModel;
use CodeIgniter\HTTP\ResponseInterface;

class HargaController extends BaseController
{
    protected $hargaModel;
    protected $muridModel;
    protected $validation;

    public function __construct()
    {
        $this->hargaModel = new HargaModel();
        $this->muridModel = new MuridModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $harga_perjam = $this->hargaModel->getHarga();
        $peserta_didik = $this->muridModel->getDataMuridAktif();

        $data = [
            'title' => 'Upah Perjam',
            'harga_perjam' => $harga_perjam,
            'peserta_didik' => $peserta_didik,
        ];

        return view('admin/harga_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

                'media_belajar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Media Belajar Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'harga' => $this->validation->getError('harga'),
                        'media_belajar' => $this->validation->getError('media_belajar'),

                    ]
                ];
            } else {

                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $harga = $this->request->getPost('harga');
                $media_belajar = $this->request->getPost('media_belajar');

                $this->hargaModel->save([
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'harga' => strtolower($harga),
                    'media_belajar' => strtolower($media_belajar),

                ]);

                $alert = [
                    'success' => 'Upah Anak Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $harga = $this->hargaModel->where(["id" => $id])->first();
            $peserta_didik = $this->muridModel->getDataMuridAktif();

            $data = [
                'harga' => $harga,
                'peserta_didik' => $peserta_didik
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $harga = $this->hargaModel->where(["id" => $id])->first();

            $this->hargaModel->delete($harga["id"]);

            $alert = [
                'success' => 'Upah Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],
                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],
                'media_belajar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Media Belajar Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'harga' => $this->validation->getError('harga'),
                        'media_belajar' => $this->validation->getError('media_belajar'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $harga = $this->request->getPost('harga');
                $media_belajar = $this->request->getPost('media_belajar');

                $this->hargaModel->update($id, [
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'harga' => strtolower($harga),
                    'media_belajar' => strtolower($media_belajar),

                ]);

                $alert = [
                    'success' => 'Upah Anak Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
