<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HargaMitraModel;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\MuridModel;
use App\Models\Admin\PengajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class HargaMitraController extends BaseController
{
    protected $hargaMitraModel;
    protected $pengajarModel;
    protected $validation;
    protected $muridModel;
    protected $kelompokBelajarModel;

    public function __construct()
    {
        $this->hargaMitraModel = new HargaMitraModel();
        $this->pengajarModel = new PengajarModel();
        $this->validation = \Config\Services::validation();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->muridModel = new MuridModel();
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
                'booster_media' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Booster Media Tidak Boleh Kosong !'
                    ]
                ],
                'bulan' => [
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
                        'bulan' => $this->validation->getError('bulan'),
                        'booster_media' => $this->validation->getError('booster_media'),
                        'harga_mitra' => $this->validation->getError('harga_mitra'),

                    ]
                ];
            } else {

                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $bulan = $this->request->getPost('bulan');
                $booster_media = $this->request->getPost('booster_media');
                $harga_mitra = $this->request->getPost('harga_mitra');
                $tahun = date('Y');

                $this->hargaMitraModel->save([
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'bulan' => strtolower($bulan),
                    'tahun' => strtolower($tahun),
                    'booster_media' => strtolower($booster_media),
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
                'booster_media' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Booster Media Tidak Boleh Kosong !'
                    ]
                ],
                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Tidak Boleh Kosong !'
                    ]
                ],
                'tahun' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tahun Tidak Boleh Kosong !'
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
                        'booster_media' => $this->validation->getError('booster_media'),
                        'bulan' => $this->validation->getError('bulan'),
                        'tahun' => $this->validation->getError('tahun'),
                        'harga_mitra' => $this->validation->getError('harga_mitra'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $bulan = $this->request->getPost('bulan');
                $booster_media = $this->request->getPost('booster_media');
                $harga = $this->request->getPost('harga_mitra');
                $tahun = $this->request->getPost('tahun');

                $this->hargaMitraModel->update($id, [
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'booster_media' => strtolower($booster_media),
                    'bulan' => strtolower($bulan),
                    'tahun' => strtolower($tahun),
                    'harga_mitra' => strtolower($harga),
                ]);

                $alert = [
                    'success' => 'Upah Mitra Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function update_harga()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'bulan' => $this->validation->getError('bulan'),
                    ]
                ];
            } else {

                $bulan = $this->request->getPost('bulan');
                $tahun = date('Y');

                $peserta_didik = $this->muridModel->getDataMuridAktif();
                // dd($peserta_didik);

                foreach ($peserta_didik as $peserta) {

                    $data_harga = $this->hargaMitraModel->where(["peserta_didik_id" => $peserta->id])->orderBy('id')->get()->getRowObject();

                    if ($data_harga != null) {

                        $data_harga_berdasarkan_bulan = $this->hargaMitraModel->where(["peserta_didik_id" => $peserta->id])->where(["bulan" => $bulan])->where(["tahun" => $tahun])->get()->getRowObject();

                        if ($data_harga_berdasarkan_bulan == null) {
                            $this->hargaMitraModel->save([
                                'mitra_pengajar_id' => strtolower($data_harga->mitra_pengajar_id),
                                'peserta_didik_id' => strtolower($data_harga->peserta_didik_id),
                                'bulan' => $bulan,
                                'tahun' => $tahun,
                                'harga_mitra' => strtolower($data_harga->harga_mitra),
                                'booster_media' => strtolower($data_harga->booster_media),
                            ]);
                            $alert = [
                                'success' => 'Upah Mitra Berhasil di Simpan !'
                            ];
                        } elseif ($data_harga_berdasarkan_bulan != null) {
                            $alert = [
                                'error' => [
                                    'data' => 'Upah Bulan Tersebut Sudah terdaptar!'
                                ],
                            ];
                        }
                    }
                }
            }
            return json_encode($alert);
        }
    }
}
