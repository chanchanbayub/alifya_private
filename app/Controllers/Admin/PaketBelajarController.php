<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PaketBelajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class PaketBelajarController extends BaseController
{
    protected $paketBelajarModel;
    protected $validation;

    public function __construct()
    {
        $this->paketBelajarModel = new PaketBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Paket Belajar',
            'paket_belajar' => $this->paketBelajarModel->getPaketBelajar()
        ];

        return view('admin/paket_belajar_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_paket' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Paket Tidak Boleh Kosong !'
                    ]
                ],
                'jumlah_pertemuan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jumlah Pertemuan Tidak Boleh Kosong !'
                    ]
                ],
                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harga Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_paket' => $this->validation->getError('nama_paket'),
                        'jumlah_pertemuan' => $this->validation->getError('jumlah_pertemuan'),
                        'harga' => $this->validation->getError('harga'),
                    ]
                ];
            } else {

                $nama_paket = $this->request->getPost('nama_paket');
                $jumlah_pertemuan = $this->request->getPost('jumlah_pertemuan');
                $harga = $this->request->getPost('harga');

                $this->paketBelajarModel->save([
                    'nama_paket' => strtolower($nama_paket),
                    'jumlah_pertemuan' => strtolower($jumlah_pertemuan),
                    'harga' => strtolower($harga),
                ]);

                $alert = [
                    'success' => 'Paket Belajar Berhasil diSimpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $paket = $this->paketBelajarModel->where(["id" => $id])->first();

            return json_encode($paket);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $paket = $this->paketBelajarModel->where(["id" => $id])->first();

            $this->paketBelajarModel->delete($paket["id"]);

            $alert = [
                'success' => 'Paket Belajar Berhasil diHapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([

                'nama_paket' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Paket Tidak Boleh Kosong !'
                    ]
                ],
                'jumlah_pertemuan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jumlah Pertemuan Tidak Boleh Kosong !'
                    ]
                ],
                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harga Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_paket' => $this->validation->getError('nama_paket'),
                        'jumlah_pertemuan' => $this->validation->getError('jumlah_pertemuan'),
                        'harga' => $this->validation->getError('harga'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $nama_paket = $this->request->getPost('nama_paket');
                $jumlah_pertemuan = $this->request->getPost('jumlah_pertemuan');
                $harga = $this->request->getPost('harga');

                $this->paketBelajarModel->update($id, [
                    'nama_paket' => strtolower($nama_paket),
                    'jumlah_pertemuan' => strtolower($jumlah_pertemuan),
                    'harga' => strtolower($harga),
                ]);

                $alert = [
                    'success' => 'Program Belajar Berhasil diUbah!'
                ];
            }

            return json_encode($alert);
        }
    }
}
