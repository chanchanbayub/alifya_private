<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KelompokModel;
use App\Models\Admin\MuridModel;
use App\Models\Admin\PengajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class KelompokBelajarController extends BaseController
{
    protected $kelompokBelajarModel;
    protected $kelompokModel;
    protected $pengajarModel;
    protected $muridModel;
    protected $validation;

    public function __construct()
    {
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->kelompokModel = new KelompokModel();
        $this->pengajarModel = new PengajarModel();
        $this->muridModel = new MuridModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Kelompok Belajar',
            'kelompok_belajar' => $this->kelompokBelajarModel->getKelompokBelajar(),
            'kelompok' => $this->kelompokModel->getKelompokPengajar(),
            'pengajar' => $this->pengajarModel->getDataPengajar(),
            'murid' => $this->muridModel->getDataMuridWaiting()
        ];

        return view('admin/kelompok_belajar_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'kelompok_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kelompok Tidak Boleh Kosong !'
                    ]
                ],
                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Peserta Didik Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'kelompok_id' => $this->validation->getError('kelompok_id'),
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                    ]
                ];
            } else {

                $kelompok_id = $this->request->getPost('kelompok_id');
                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $peserta_didik  = $this->muridModel->where(["id" => $peserta_didik_id])->first();

                $this->kelompokBelajarModel->save([
                    'kelompok_id' => strtolower($kelompok_id),
                    'peserta_didik_id' => strtolower($peserta_didik_id),

                ]);

                $this->muridModel->update(
                    $peserta_didik["id"],
                    [
                        'status_murid_id' => 1
                    ]
                );

                $alert = [
                    'success' => 'Kelompok Belajar Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kelompok_belajar = $this->kelompokBelajarModel->where(["id" => $id])->first();
            $kelompok_pengajar = $this->kelompokModel->getKelompokPengajar();
            $murid = $this->muridModel->getDataListMurid();

            $data = [
                'kelompok_belajar' => $kelompok_belajar,
                'kelompok_pengajar' => $kelompok_pengajar,
                'murid' => $murid
            ];


            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kelompok_belajar = $this->kelompokBelajarModel->where(["id" => $id])->first();

            $this->kelompokBelajarModel->delete($kelompok_belajar["id"]);

            $this->muridModel->update(
                $kelompok_belajar["peserta_didik_id"],
                [
                    'status_murid_id' => 2
                ]
            );
            $alert = [
                'success' => 'Kelompok Belajar Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if (!$this->validate([
            'kelompok_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelompok Tidak Boleh Kosong !'
                ]
            ],
            'peserta_didik_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Peserta Didik Tidak Boleh Kosong !'
                ]
            ],
        ])) {
            $alert = [
                'error' => [
                    'kelompok_id' => $this->validation->getError('kelompok_id'),
                    'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                ]
            ];
        } else {

            $id = $this->request->getVar('id');

            $kelompok_belajar_update = $this->kelompokBelajarModel->where(["id" => $id])->first();

            $kelompok_id = $this->request->getPost('kelompok_id');
            $peserta_didik_id = $this->request->getPost('peserta_didik_id');

            if ($kelompok_belajar_update["peserta_didik_id"] != $peserta_didik_id) {
                $this->muridModel->update(
                    $kelompok_belajar_update["peserta_didik_id"],
                    [
                        'status_murid_id' => 2
                    ]
                );
            }
            $this->kelompokBelajarModel->update($id, [
                'kelompok_id' => strtolower($kelompok_id),
                'peserta_didik_id' => strtolower($peserta_didik_id),

            ]);

            $this->muridModel->update($peserta_didik_id, [
                'status_murid_id' => 1
            ]);

            $alert = [
                'success' => 'Kelompok Belajar Berhasil di Ubah !'
            ];
        }

        return json_encode($alert);
    }
}
