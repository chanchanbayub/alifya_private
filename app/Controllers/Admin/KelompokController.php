<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KelompokModel;
use App\Models\Admin\MuridModel;
use App\Models\Admin\PengajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class KelompokController extends BaseController
{
    protected $kelompokModel;
    protected $muridModel;
    protected $kelompokBelajarModel;
    protected $pengajarModel;

    protected $validation;

    public function __construct()
    {
        $this->kelompokModel = new KelompokModel();
        $this->pengajarModel = new PengajarModel();
        $this->muridModel = new MuridModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Kelompok Pengajar',
            'kelompok' => $this->kelompokModel->getKelompokPengajar(),
            'pengajar' => $this->pengajarModel->getDataPengajarStatusWaiting()
        ];

        return view('admin/kelompok_v', $data);
    }

    public function views($id)
    {

        $kelompok = $this->kelompokModel->getKelompokWithId($id);
        $kelompok_belajar = $this->kelompokBelajarModel->getUserWithKelompok($id);

        if ($kelompok == null || $kelompok_belajar == null) {
            return redirect()->back();
        }
        // dd($kelompok_belajar);
        $data = [
            'title' => 'Kelompok Belajar ',
            'kelompok' => $kelompok,
            'kelompok_belajar' => $kelompok_belajar
        ];

        return view('admin/detail_kelompok_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'kelompok' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kelompok Tidak Boleh Kosong !'
                    ]
                ],
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'kelompok' => $this->validation->getError('kelompok'),
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),

                    ]
                ];
            } else {

                $kelompok = $this->request->getPost('kelompok');
                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');

                $this->kelompokModel->save([
                    'kelompok' => strtolower($kelompok),
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),

                ]);

                $this->pengajarModel->update($mitra_pengajar_id, [
                    'status_id' => 1
                ]);


                $alert = [
                    'success' => 'Kelompok Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kelompok = $this->kelompokModel->where(["id" => $id])->first();
            $pengajar = $this->pengajarModel->getDataPengajar();

            $data = [
                'kelompok' => $kelompok,
                'pengajar' => $pengajar
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kelompok = $this->kelompokModel->where(["id" => $id])->first();

            $kelompok_belajar = $this->kelompokBelajarModel->where(["kelompok_id" => $id])->get()->getResultObject();

            foreach ($kelompok_belajar as $kelompok_belajar) {
                $this->muridModel->update($kelompok_belajar->peserta_didik_id, [
                    'status_murid_id' => 2
                ]);
            }

            $this->pengajarModel->update($kelompok["mitra_pengajar_id"], [
                'status_id' => 2
            ]);

            $this->kelompokModel->delete($kelompok["id"]);

            $alert = [
                'success' => 'Kelompok Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'kelompok' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'kelompok Tidak Boleh Kosong !'
                    ]
                ],
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'kelompok' => $this->validation->getError('kelompok'),
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                    ]
                ];
            } else {

                $id = $this->request->getVar('id');
                $kelompok = $this->request->getVar('kelompok');
                $mitra_pengajar_id = $this->request->getVar('mitra_pengajar_id');

                $kelompok_data = $this->kelompokModel->where(["id" => $id])->first();


                $this->kelompokModel->update($kelompok_data["id"], [

                    'kelompok' => strtolower($kelompok),
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),

                ]);

                $alert = [
                    'success' => 'Kelompok Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
