<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AbsensiModel;
use App\Models\Admin\HargaModel;
use App\Models\Admin\JadwalTetapModel;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KelompokModel;
use App\Models\Admin\MuridModel;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class PresensiController extends BaseController
{
    protected $presensiModel;
    protected $kelompokModel;
    protected $kelompokBelajarModel;
    protected $pengajarModel;
    protected $muridModel;
    protected $jadwalTetaModel;
    protected $hargaModel;
    protected $absensiModel;
    protected $validation;

    public function __construct()
    {
        $this->presensiModel = new PresensiModel();
        $this->kelompokModel = new KelompokModel();
        $this->pengajarModel = new PengajarModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->muridModel = new MuridModel();
        $this->hargaModel = new HargaModel();
        $this->jadwalTetaModel = new JadwalTetapModel();
        $this->absensiModel = new AbsensiModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $kelompokPengajar = $this->kelompokModel->getKelompokPengajar();

        helper(['format']);

        $data = [
            'title' => 'Presensi Mitra Pengajar',
            'presensi' => $this->presensiModel->getDataPresensi(),
            'mitra_pengajar' => $kelompokPengajar,

        ];

        return view('admin/presensi_v', $data);
    }

    public function presensi_harian()
    {
        $kelompokPengajar = $this->kelompokModel->getKelompokPengajar();

        helper(['format']);

        $tanggal_hari = date('Y/m/d');

        $presensi_harian = $this->presensiModel->getDataPresensiPerhari($tanggal_hari);


        $hari_ini = tanggal_indonesia(date('Y-m-d'));

        $jadwal_harian = $this->jadwalTetaModel->getJadwalHarian($hari_ini);

        $absensi = $this->absensiModel->getAbsensiPerhari($tanggal_hari);

        $data = [
            'title' => 'Presensi Harian',
            'presensi' => $presensi_harian,
            'mitra_pengajar' => $kelompokPengajar,
            'jadwal_harian' => $jadwal_harian,
            'absensi' => $absensi

        ];

        return view('admin/presensi_harian_v', $data);
    }

    public function presensi_bulanan()
    {
        $kelompokPengajar = $this->kelompokModel->getKelompokPengajar();

        helper(['format']);

        $tanggal_hari = date('Y/m/d');

        $presensi_bulanan = $this->presensiModel->getDataPresensiPerhari($tanggal_hari);


        $hari_ini = tanggal_indonesia(date('Y-m-d'));

        // $absensi = $this->absensiModel->getAbsensiPerhari($tanggal_hari);

        $data = [
            'title' => 'Presensi bulanan',
            'presensi' => $presensi_bulanan,
            'mitra_pengajar' => $kelompokPengajar,
        ];

        return view('admin/presensi_bulanan_v', $data);
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
                    'rules' => 'uploaded[dokumentasi]|max_size[dokumentasi,2048]|is_image[dokumentasi]|mime_in[dokumentasi,image/png,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'Dokumentasi Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
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

    public function getPresensiPerbulan()
    {
        if ($this->request->isAJAX()) {

            $mitra_pengajar_id = $this->request->getVar('mitra_pengajar_id');
            $bulan = $this->request->getVar('bulan');
            $tahun = date('Y');

            $jadwal_bulanan = $this->jadwalTetaModel->getJadwalbulanan($mitra_pengajar_id);
            $presensi = $this->presensiModel->getPresensiPerMitra($mitra_pengajar_id, $bulan, $tahun);

            $jumlah_presensi = count($presensi);

            $jumlah_paket_belajar = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajarSumPaketBelajar($mitra_pengajar_id);

            if ($jumlah_presensi > 0) {
                $presensi_ideal = number_format(intval($jumlah_presensi) / intval($jumlah_paket_belajar->total_paket_belajar) * 100);
            } else {
                $presensi_ideal = 0;
            }

            $presensi_ideal_anak = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar($mitra_pengajar_id);

            $data_presensi = [];

            foreach ($presensi_ideal_anak as $presensi_data) {
                $presensi_peranak = $this->presensiModel->getPresensiPerAnak($presensi_data->peserta_didik_id, $bulan, $tahun);
                $data_murid = $this->muridModel->getMitraMurid($presensi_data->peserta_didik_id);
                if ($presensi_peranak != null) {
                    if ($presensi_peranak->jumlah_pertemuan > 0 || $presensi_peranak->total_presensi_perbulan > 0) {
                        $data_presensi[] = [
                            'nama_lengkap_anak' => $presensi_peranak->nama_lengkap_anak,
                            'jumlah_pertemuan' => $presensi_peranak->jumlah_pertemuan,
                            'total_presensi_perbulan' => $presensi_peranak->total_presensi_perbulan,
                            'presensi_ideal_anak' => number_format(intval($presensi_peranak->total_presensi_perbulan) / intval($presensi_peranak->jumlah_pertemuan) * 100)
                        ];
                    } else {
                        $data_presensi[] = [
                            'nama_lengkap_anak' => $data_murid->nama_lengkap_anak,
                            'jumlah_pertemuan' => $data_murid->jumlah_pertemuan,
                            'total_presensi_perbulan' => $presensi_peranak->total_presensi_perbulan,
                            'presensi_ideal_anak' => 0
                        ];
                    }
                }
            }

            $absensi_data = $this->absensiModel->getAbsensiPerbulan($mitra_pengajar_id, $bulan, $tahun);

            $total_absensi = count($absensi_data);

            $data = [
                'presensi' => $presensi,
                'jadwal' => $jadwal_bulanan,
                'jumlah_presensi' => $jumlah_presensi,
                'jumlah_paket_belajar' => $jumlah_paket_belajar->total_paket_belajar,
                'presensi_ideal' => $presensi_ideal,
                'presensi_ideal_anak' => $presensi_ideal_anak,
                'data_presensi' => $data_presensi,
                'absensi_data' => $absensi_data,
                'total_absensi' => $total_absensi
            ];

            return json_encode($data);
        }
    }
}
