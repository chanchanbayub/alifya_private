<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Admin\PengajarModel;
use App\Models\Ahl\JamMasukAhlModel;
use App\Models\Ahl\JenisPekerjaanModel;
use App\Models\Ahl\LokasiModel;
use App\Models\Ahl\MitraPengajarAhlModel;
use App\Models\Ahl\PresensiAhlModel;
use App\Models\Ahl\StatusPresensiModel;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;

class PresensiAhlController extends BaseController
{
    protected $mitraPengajarAhlModel;
    protected $pengajarModel;
    protected $jenisPekerjaanModel;
    protected $statusPresensiModel;
    protected $presensiAhlModel;
    protected $jamMasukAhlModel;
    protected $lokasiModel;
    protected $validation;

    public function __construct()
    {
        $this->mitraPengajarAhlModel = new MitraPengajarAhlModel();
        $this->jamMasukAhlModel = new JamMasukAhlModel();
        $this->presensiAhlModel = new PresensiAhlModel();
        $this->pengajarModel = new PengajarModel();
        $this->lokasiModel = new LokasiModel();
        $this->jenisPekerjaanModel = new JenisPekerjaanModel();
        $this->statusPresensiModel = new StatusPresensiModel();
        $this->validation = \Config\Services::validation();

        helper(['format']);
    }


    public function index()
    {
        $data = [
            'title' => 'Presensi AHL',
            'presensi_ahl' => $this->presensiAhlModel->getPresensiAhl(),
            'lokasi' => $this->lokasiModel->getLokasi(),
            'jenis_pekerjaan' => $this->jenisPekerjaanModel->getJenisPekerjaan(),
            'status_presensi' => $this->statusPresensiModel->getStatusPresensi(),
            'mitra_pengajar_ahl' => $this->mitraPengajarAhlModel->getMitraPengajarAhl(),
        ];

        return view('ahl/presensi_ahl_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong!'
                    ]
                ],

                'jenis_pekerjaan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Pekerjaan Tidak Boleh Kosong!'
                    ]
                ],

                'tanggal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Tidak Boleh Kosong!'
                    ]
                ],

                'jam' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam Tidak Boleh Kosong!'
                    ]
                ],

                'lokasi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Tidak Boleh Kosong!'
                    ]
                ],

                'status_presensi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Presensi Tidak Boleh Kosong!'
                    ]
                ],
                'dokumentasi' => [
                    'rules' => 'uploaded[dokumentasi]|max_size[dokumentasi,10000]|is_image[dokumentasi]|mime_in[dokumentasi,image/png,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'Dokumentasi Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 10MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],



            ])) {
                $alert = [
                    'error' => [
                        'mitra_id' => $this->validation->getError('mitra_id'),
                        'jenis_pekerjaan_id' => $this->validation->getError('jenis_pekerjaan_id'),
                        'tanggal' => $this->validation->getError('tanggal'),
                        'jam' => $this->validation->getError('jam'),
                        'lokasi_id' => $this->validation->getError('lokasi_id'),
                        'status_presensi_id' => $this->validation->getError('status_presensi_id'),
                        'dokumentasi' => $this->validation->getError('dokumentasi'),

                    ]
                ];
            } else {

                $mitra_id = $this->request->getPost('mitra_id');
                $jenis_pekerjaan_id = $this->request->getPost('jenis_pekerjaan_id');
                $tanggal = $this->request->getPost('tanggal');
                $jam = $this->request->getPost('jam');
                $lokasi_id = $this->request->getPost('lokasi_id');
                $lain_lain = $this->request->getPost('lain_lain');
                $status_presensi_id = $this->request->getPost('status_presensi_id');

                $dokumentasi = $this->request->getFile('dokumentasi');
                $nama_foto = $dokumentasi->getRandomName();

                $jenis_pekerjaan_data = $this->jamMasukAhlModel->where(["id" => $jenis_pekerjaan_id])->get()->getRowObject();

                if ($jenis_pekerjaan_data->jenis_pekerjaan_id == 1) {
                    if ($status_presensi_id == 1) {

                        // Jam Jadwal
                        $tanggal_hari_ini = date_create();
                        $format_tanggal = date_format($tanggal_hari_ini, "Y-m-d");
                        $data_waktu = $format_tanggal . ' ' . $jenis_pekerjaan_data->jam_masuk_ahl;
                        $waktu_hari_ini = date_create($data_waktu);

                        // jam presensi
                        $tanggal_inputan = date_create($tanggal);
                        $tanggal_presensi = date_format($tanggal_inputan, "Y-m-d");
                        $gabung_waktu = $tanggal_presensi . ' ' . $jam;
                        $waktu_presensi = date_create($gabung_waktu);

                        $selisih = date_diff($waktu_presensi, $waktu_hari_ini);

                        if ($waktu_presensi <= $waktu_hari_ini) {
                            $interval = "00:00:00";
                        } else {
                            $interval = $selisih->format("%H:%I:%S");
                        }
                    } elseif ($status_presensi_id == 2) {
                        // Jam Jadwal
                        $tanggal_hari_ini = date_create();
                        $format_tanggal = date_format($tanggal_hari_ini, "Y-m-d");
                        $data_waktu = $format_tanggal . ' ' . $jenis_pekerjaan_data->jam_pulang_ahl;
                        $waktu_hari_ini = date_create($data_waktu);

                        // jam presensi
                        $tanggal_inputan = date_create($tanggal);
                        $tanggal_presensi = date_format($tanggal_inputan, "Y-m-d");
                        $gabung_waktu = $tanggal_presensi . ' ' . $jam;
                        $waktu_presensi = date_create($gabung_waktu);

                        $selisih = date_diff($waktu_presensi, $waktu_hari_ini);

                        if ($waktu_presensi >= $waktu_hari_ini) {
                            $interval = "00:00:00";
                        } else {
                            $interval = $selisih->format("%H:%I:%S");
                        }
                    } elseif ($status_presensi_id == 3) {

                        $interval = "00:00:00";
                    }
                } elseif ($jenis_pekerjaan_data->jenis_pekerjaan_id == 2) {

                    $interval = "00:00:00";
                }



                $this->presensiAhlModel->save([
                    'mitra_id' => strtolower($mitra_id),
                    'jenis_pekerjaan_id' => strtolower($jenis_pekerjaan_id),
                    'tanggal' => strtolower($tanggal),
                    'jam' => strtolower($jam),
                    'lain_lain' => strtolower($lain_lain),
                    'lokasi_id' => strtolower($lokasi_id),
                    'status_presensi_id' => strtolower($status_presensi_id),
                    'keterangan' => $interval,
                    'dokumentasi' => $nama_foto,

                ]);

                $dokumentasi->move('dokumentasi_ahl', $nama_foto);

                $alert = [
                    'success' => 'Presensi Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $lokasi = $this->lokasiModel->getLokasi();
            $jenis_pekerjaan = $this->jenisPekerjaanModel->getJenisPekerjaan();
            $status_presensi = $this->statusPresensiModel->getStatusPresensi();
            $mitra_pengajar_ahl = $this->mitraPengajarAhlModel->getMitraPengajarAhl();

            $presensi_ahl = $this->presensiAhlModel->where(["id" => $id])->get()->getRowObject();

            $data = [
                'lokasi' => $lokasi,
                'jenis_pekerjaan' => $jenis_pekerjaan,
                'status_presensi' => $status_presensi,
                'mitra_pengajar_ahl' => $mitra_pengajar_ahl,
                'presensi_ahl' => $presensi_ahl,
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $presensi_ahl = $this->presensiAhlModel->where(["id" => $id])->first();

            $this->presensiAhlModel->delete($presensi_ahl["id"]);

            if ($presensi_ahl["dokumentasi"] != null) {
                $path_dokumentasi =  'dokumentasi_ahl/' . $presensi_ahl['dokumentasi'];
                if (file_exists($path_dokumentasi)) {
                    unlink($path_dokumentasi);
                }
            }

            $alert = [
                'success' => 'Presensi Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong!'
                    ]
                ],

                'jenis_pekerjaan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Pekerjaan Tidak Boleh Kosong!'
                    ]
                ],

                'tanggal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Tidak Boleh Kosong!'
                    ]
                ],

                'jam' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam Tidak Boleh Kosong!'
                    ]
                ],

                'lokasi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Tidak Boleh Kosong!'
                    ]
                ],

                'status_presensi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Presensi Tidak Boleh Kosong!'
                    ]
                ],




            ])) {
                $alert = [
                    'error' => [
                        'mitra_id' => $this->validation->getError('mitra_id'),
                        'jenis_pekerjaan_id' => $this->validation->getError('jenis_pekerjaan_id'),
                        'tanggal' => $this->validation->getError('tanggal'),
                        'jam' => $this->validation->getError('jam'),
                        'lokasi_id' => $this->validation->getError('lokasi_id'),
                        'status_presensi_id' => $this->validation->getError('status_presensi_id'),


                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $foto_lama = $this->request->getPost('foto_lama');
                $mitra_id = $this->request->getPost('mitra_id');
                $jenis_pekerjaan_id = $this->request->getPost('jenis_pekerjaan_id');
                $tanggal = $this->request->getPost('tanggal');
                $jam = $this->request->getPost('jam');
                $lokasi_id = $this->request->getPost('lokasi_id');
                $lain_lain = $this->request->getPost('lain_lain');
                $status_presensi_id = $this->request->getPost('status_presensi_id');

                $dokumentasi = $this->request->getFile('dokumentasi');
                $path_foto_lama = 'dokumentasi_ahl/' . $foto_lama;


                if ($dokumentasi->getError() == 4) {
                    $nama_foto = $foto_lama;
                } else {
                    if (file_exists($path_foto_lama)) {
                        unlink($path_foto_lama);
                    }
                    $nama_foto = $dokumentasi->getRandomName();
                    $dokumentasi->move('dokumentasi_ahl', $nama_foto);
                }

                $jenis_pekerjaan_data = $this->jamMasukAhlModel->where(["id" => $jenis_pekerjaan_id])->get()->getRowObject();

                if ($jenis_pekerjaan_data->jenis_pekerjaan_id == 1) {
                    if ($status_presensi_id == 1) {

                        // Jam Jadwal
                        $tanggal_hari_ini = date_create();
                        $format_tanggal = date_format($tanggal_hari_ini, "Y-m-d");
                        $data_waktu = $format_tanggal . ' ' . $jenis_pekerjaan_data->jam_masuk_ahl;
                        $waktu_hari_ini = date_create($data_waktu);

                        // jam presensi
                        $tanggal_inputan = date_create($tanggal);
                        $tanggal_presensi = date_format($tanggal_inputan, "Y-m-d");
                        $gabung_waktu = $tanggal_presensi . ' ' . $jam;
                        $waktu_presensi = date_create($gabung_waktu);

                        $selisih = date_diff($waktu_presensi, $waktu_hari_ini);

                        if ($waktu_presensi <= $waktu_hari_ini) {
                            $interval = "00:00:00";
                        } else {
                            $interval = $selisih->format("%H:%I:%S");
                        }
                    } elseif ($status_presensi_id == 2) {
                        // Jam Jadwal
                        $tanggal_hari_ini = date_create();
                        $format_tanggal = date_format($tanggal_hari_ini, "Y-m-d");
                        $data_waktu = $format_tanggal . ' ' . $jenis_pekerjaan_data->jam_pulang_ahl;
                        $waktu_hari_ini = date_create($data_waktu);

                        // jam presensi
                        $tanggal_inputan = date_create($tanggal);
                        $tanggal_presensi = date_format($tanggal_inputan, "Y-m-d");
                        $gabung_waktu = $tanggal_presensi . ' ' . $jam;
                        $waktu_presensi = date_create($gabung_waktu);

                        $selisih = date_diff($waktu_presensi, $waktu_hari_ini);

                        if ($waktu_presensi >= $waktu_hari_ini) {
                            $interval = "00:00:00";
                        } else {
                            $interval = $selisih->format("%H:%I:%S");
                        }
                    } elseif ($status_presensi_id == 3) {

                        $interval = "00:00:00";
                    }
                } elseif ($jenis_pekerjaan_data->jenis_pekerjaan_id == 2) {
                    $interval = "00:00:00";
                }

                $this->presensiAhlModel->update($id, [
                    'mitra_id' => strtolower($mitra_id),
                    'jenis_pekerjaan_id' => strtolower($jenis_pekerjaan_id),
                    'tanggal' => strtolower($tanggal),
                    'jam' => strtolower($jam),
                    'lain_lain' => strtolower($lain_lain),
                    'lokasi_id' => strtolower($lokasi_id),
                    'status_presensi_id' => strtolower($status_presensi_id),
                    'keterangan' => $interval,
                    'dokumentasi' => $nama_foto,

                ]);

                $alert = [
                    'success' => 'Presensi Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }
}
