<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Mitra\KelompokBelajarModel;
use App\Models\Mitra\KelompokModel;
use App\Models\Mitra\MuridModel;
use App\Models\Mitra\PengajarModel;
use App\Models\Mitra\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class PresensiController extends BaseController
{
    protected $presensiModel;
    protected $kelompokModel;
    protected $kelompokBelajarModel;
    protected $pengajarModel;
    protected $muridModel;
    protected $hargaModel;
    protected $validation;

    public function __construct()
    {
        $this->presensiModel = new PresensiModel();
        $this->kelompokModel = new KelompokModel();
        $this->pengajarModel = new PengajarModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->muridModel = new MuridModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $kelompokPengajar = $this->kelompokModel->getKelompokPengajarWithMitraPengajar(session()->get('mitra_pengajar_id'));

        $data = [
            'title' => 'Presensi Mitra Pengajar',
            'presensi' => $this->presensiModel->getPresensi(session()->get('mitra_pengajar_id')),
            'mitra_pengajar' => $kelompokPengajar,

        ];

        return view('mitra/presensi_v', $data);
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

                'tanggal_masuk' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Masuk Tidak Boleh Kosong !'
                    ]
                ],
                'jam_masuk' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam Masuk Tidak Boleh Kosong !'
                    ]
                ],
                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Peserta Didik  Tidak Boleh Kosong !'
                    ]
                ],
                'dokumentasi' => [
                    'rules' => 'uploaded[dokumentasi]|max_size[dokumentasi,5000]|is_image[dokumentasi]|mime_in[dokumentasi,image/png,image/jpeg,image/jpg]',
                    'errors' => [
                        'uploaded' => 'Dokumentasi Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 5MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'tanggal_masuk' => $this->validation->getError('tanggal_masuk'),
                        'jam_masuk' => $this->validation->getError('jam_masuk'),
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'dokumentasi' => $this->validation->getError('dokumentasi'),

                    ]
                ];
            } else {

                $mitra_pengajar_id = $this->request->getVar('mitra_pengajar_id');
                $tanggal_masuk = $this->request->getVar('tanggal_masuk');
                $jam_masuk = $this->request->getVar('jam_masuk');
                $peserta_didik_id = $this->request->getVar('peserta_didik_id');
                $dokumentasi = $this->request->getFile('dokumentasi');

                $nama_foto = $dokumentasi->getRandomName();

                $this->presensiModel->save([
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'tanggal_masuk' => strtolower($tanggal_masuk),
                    'jam_masuk' => strtolower($jam_masuk),
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'dokumentasi' => strtolower($nama_foto),

                ]);

                $dokumentasi->move('dokumentasi', $nama_foto);

                $alert = [
                    'success' => 'Presensi Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }



    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $presensi = $this->presensiModel->where(["id" => $id])->first();

            $kelompokPengajar = $this->kelompokModel->getKelompokPengajar();

            $peserta_didik = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar($presensi["mitra_pengajar_id"]);


            $data = [
                'presensi' => $presensi,
                'mitra_pengajar' => $kelompokPengajar,
                'peserta_didik' => $peserta_didik
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $presensi = $this->presensiModel->where(["id" => $id])->first();

            $path_dokumentasi =  'dokumentasi/' . $presensi['dokumentasi'];

            $this->presensiModel->delete($presensi["id"]);

            $alert = [
                'success' => 'Presensi Berhasil di Hapus !'
            ];

            if ($presensi['dokumentasi'] != null) {
                if (file_exists($path_dokumentasi)) {
                    unlink($path_dokumentasi);
                }
            }

            return json_encode($alert);
        }
    }

    public function update()
    {
        if (!$this->validate([
            'mitra_pengajar_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mitra Pengajar Tidak Boleh Kosong !'
                ]
            ],

            'tanggal_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Masuk Tidak Boleh Kosong !'
                ]
            ],
            'jam_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Masuk Tidak Boleh Kosong !'
                ]
            ],
            'peserta_didik_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Peserta Didik  Tidak Boleh Kosong !'
                ]
            ],

        ])) {
            $alert = [
                'error' => [
                    'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                    'tanggal_masuk' => $this->validation->getError('tanggal_masuk'),
                    'jam_masuk' => $this->validation->getError('jam_masuk'),
                    'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                ]
            ];
        } else {

            $id = $this->request->getVar('id');
            $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
            $foto_lama = $this->request->getPost('foto_lama');
            $tanggal_masuk = $this->request->getPost('tanggal_masuk');
            $jam_masuk = $this->request->getPost('jam_masuk');
            $peserta_didik_id = $this->request->getPost('peserta_didik_id');
            $dokumentasi = $this->request->getFile('dokumentasi');

            $path_foto_lama = 'dokumentasi/' . $foto_lama;

            if ($dokumentasi->getError() == 4) {
                $nama_foto = $foto_lama;
            } else {
                if (file_exists($path_foto_lama)) {
                    unlink($path_foto_lama);
                }
                $nama_foto = $dokumentasi->getRandomName();
                $dokumentasi->move('dokumentasi', $nama_foto);
            }

            $this->presensiModel->update($id, [
                'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                'foto_lama' => strtolower($foto_lama),
                'tanggal_masuk' => strtolower($tanggal_masuk),
                'jam_masuk' => strtolower($jam_masuk),
                'peserta_didik_id' => strtolower($peserta_didik_id),
                'dokumentasi' => strtolower($nama_foto),
            ]);

            $alert = [
                'success' => 'Presensi Berhasil di Update !'
            ];
        }

        return json_encode($alert);
    }
}
