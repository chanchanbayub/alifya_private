<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HariBelajarModel;
use App\Models\Admin\JadwalTetapModel;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\MuridModel;
use App\Models\Admin\PengajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class JadwalTetapController extends BaseController
{
    protected $pengajarModel;
    protected $muridModel;
    protected $jadwalTetapModel;
    protected $hariBelajarModel;
    protected $kelompokBelajarModel;
    protected $validation;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->muridModel = new MuridModel();
        $this->jadwalTetapModel = new JadwalTetapModel();
        $this->hariBelajarModel = new HariBelajarModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Jadwal Tetap Mitra',
            'hari_belajar' => $this->hariBelajarModel->getHari(),
            'mitra_pengajar' => $this->pengajarModel->getDataPengajarStatusAktif(),
            'hari_belajar' => $this->hariBelajarModel->getHari(),
            'jadwal_tetap' => $this->jadwalTetapModel->getJadwal()
        ];

        return view('admin/jadwal_tetap_v', $data);
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
                'hari_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'jam_belajar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'hari_id' => $this->validation->getError('hari_id'),
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'jam_belajar' => $this->validation->getError('jam_belajar'),
                    ]
                ];
            } else {

                $hari_id = $this->request->getPost('hari_id');
                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $jam_belajar = $this->request->getPost('jam_belajar');

                $this->jadwalTetapModel->save([
                    'hari_id' => strtolower($hari_id),
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'jam_belajar' => strtolower($jam_belajar),

                ]);

                $alert = [
                    'success' => 'Jadwal Berhasil diSimpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $jadwalTetapModel = $this->jadwalTetapModel->where(["id" => $id])->get()->getRowObject();

            $data = [
                'jadwal_tetap' => $jadwalTetapModel,
                'hari' => $this->hariBelajarModel->getHari(),
                'mitra_pengajar' => $this->pengajarModel->getDataPengajarStatusAktif(),
                'peserta_didik' => $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar($jadwalTetapModel->mitra_pengajar_id)
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $jadwal_tetap = $this->jadwalTetapModel->where(["id" => $id])->first();

            $this->jadwalTetapModel->delete($jadwal_tetap["id"]);

            $alert = [
                'success' => 'Jadwal Berhasil diHapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'hari_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'jam_belajar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'hari_id' => $this->validation->getError('hari_id'),
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'jam_belajar' => $this->validation->getError('jam_belajar'),
                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $hari_id = $this->request->getPost('hari_id');
                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $jam_belajar = $this->request->getPost('jam_belajar');

                $this->jadwalTetapModel->update($id, [
                    'hari_id' => strtolower($hari_id),
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'jam_belajar' => strtolower($jam_belajar),

                ]);

                $alert = [
                    'success' => 'Jadwal Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
