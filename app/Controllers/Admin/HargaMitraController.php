<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HargaMitraModel;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\PengajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class HargaMitraController extends BaseController
{
    protected $hargaMitraModel;
    protected $pengajarModel;
    protected $validation;
    protected $kelompokBelajarModel;

    public function __construct()
    {
        $this->hargaMitraModel = new HargaMitraModel();
        $this->pengajarModel = new PengajarModel();
        $this->validation = \Config\Services::validation();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
    }

    public function index()
    {

        $harga_perjam = $this->hargaMitraModel->getHargaMitra();
        $mitra_pengajar = $this->pengajarModel->getDataPengajarStatusAktif();

        $data = [
            'title' => 'Upah Mitra Perjam',
            'harga_perjam' => $harga_perjam,
            'mitra_pengajar' => $mitra_pengajar,
        ];

        return view('admin/harga_mitra_v', $data);
    }

    public function getPesertaDidik()
    {
        if ($this->request->isAJAX()) {

            $mitra_pengajar_id = $this->request->getVar('mitra_pengajar_id');

            $peserta_didik = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar($mitra_pengajar_id);

            $data = [
                'peserta_didik' => $peserta_didik
            ];

            return json_encode($data);
        }
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !'
                    ]
                ],
                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Peserta Didik Tidak Boleh Kosong !'
                    ]
                ],
                'bulan_mitra' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Tidak Boleh Kosong !'
                    ]
                ],
                'harga_mitra' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'bulan_mitra' => $this->validation->getError('bulan_mitra'),
                        'harga_mitra' => $this->validation->getError('harga_mitra'),

                    ]
                ];
            } else {

                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $bulan_mitra = $this->request->getPost('bulan_mitra');
                $harga_mitra = $this->request->getPost('harga_mitra');

                $this->hargaMitraModel->save([
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'bulan_mitra' => strtolower($bulan_mitra),
                    'harga_mitra' => strtolower($harga_mitra),

                ]);

                $alert = [
                    'success' => 'Upah Mitra Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $harga = $this->hargaMitraModel->where(["id" => $id])->get()->getRowObject();

            $mitra_pengajar = $this->pengajarModel->getDataPengajarStatusAktif();

            $peserta_didik = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar($harga->mitra_pengajar_id);

            $data = [
                'harga_mitra' => $harga,
                'mitra_pengajar' => $mitra_pengajar,
                'murid' => $peserta_didik
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $harga = $this->hargaMitraModel->where(["id" => $id])->first();

            $this->hargaMitraModel->delete($harga["id"]);

            $alert = [
                'success' => 'Upah Mitra Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Peserta Didik Tidak Boleh Kosong !'
                    ]
                ],
                'bulan_mitra' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Tidak Boleh Kosong !'
                    ]
                ],
                'harga_mitra' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'bulan_mitra' => $this->validation->getError('bulan_mitra'),
                        'harga_mitra' => $this->validation->getError('harga_mitra'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $bulan = $this->request->getPost('bulan_mitra');
                $harga = $this->request->getPost('harga_mitra');

                $this->hargaMitraModel->update($id, [
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'bulan_mitra' => strtolower($bulan),
                    'harga_mitra' => strtolower($harga),

                ]);

                $alert = [
                    'success' => 'Upah Mitra Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
