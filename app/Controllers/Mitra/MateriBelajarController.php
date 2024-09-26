<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Mitra\MateriBelajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class MateriBelajarController extends BaseController
{
    protected $materiBelajarModel;
    protected $validation;

    public function __construct()
    {
        $this->materiBelajarModel = new MateriBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Materi Belajar',
            'materi_belajar' => $this->materiBelajarModel->getMateriBelajar()
        ];

        return view('mitra/materi_belajar_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'level' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Level Tidak Boleh Kosong !'
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keterangan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'level' => $this->validation->getError('level'),
                        'keterangan' => $this->validation->getError('keterangan'),
                    ]
                ];
            } else {

                $level = $this->request->getPost('level');
                $keterangan = $this->request->getPost('keterangan');

                $this->materiBelajarModel->save([
                    'level' => strtolower($level),
                    'keterangan' => strtolower($keterangan),

                ]);

                $alert = [
                    'success' => 'Keterangan Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $Materi = $this->materiBelajarModel->where(["id" => $id])->first();

            return json_encode($Materi);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $Materi = $this->materiBelajarModel->where(["id" => $id])->first();

            $this->materiBelajarModel->delete($Materi["id"]);

            $alert = [
                'success' => 'Materi Belajar Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([

                'level' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Level Tidak Boleh Kosong !'
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'keterangan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'level' => $this->validation->getError('level'),
                        'keterangan' => $this->validation->getError('keterangan'),

                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $level = $this->request->getPost('level');
                $keterangan = $this->request->getPost('keterangan');

                $this->materiBelajarModel->update($id, [
                    'level' => strtolower($level),
                    'keterangan' => strtolower($keterangan),
                ]);

                $alert = [
                    'success' => 'Materi Belajar Berhasil di Update !'
                ];
            }

            return json_encode($alert);
        }
    }
}
