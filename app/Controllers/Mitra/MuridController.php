<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Admin\PaketBelajarModel;
use App\Models\Admin\PembimbingModel;
use App\Models\Admin\ProgramBelajarModel;
use App\Models\Admin\StatusMuridModel;
use App\Models\Ahl\TingkatPendidikanModel;
use App\Models\Mitra\KelompokBelajarModel;
use App\Models\Mitra\MateriBelajarModel;
use App\Models\Mitra\MuridModel;
use CodeIgniter\HTTP\ResponseInterface;

class MuridController extends BaseController
{
    protected $muridModel;
    protected $kelompokBelajarModel;
    protected $statusMuridModel;
    protected $programBelajarModel;
    protected $materiBelajarModel;
    protected $paketBelajarModel;
    protected $tingkatPendidikanModel;
    protected $pembimbingModel;

    protected $validation;

    public function __construct()
    {
        $this->muridModel = new MuridModel();
        $this->pembimbingModel = new PembimbingModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->statusMuridModel = new StatusMuridModel();
        $this->programBelajarModel = new ProgramBelajarModel();
        $this->materiBelajarModel = new MateriBelajarModel();
        $this->paketBelajarModel = new PaketBelajarModel();
        $this->tingkatPendidikanModel = new TingkatPendidikanModel();

        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        // dd('helo');
        $data_murid = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar(session()->get('mitra_pengajar_id'));
        // dd($data_murid);

        $data = [
            'title' => 'Peserta Didik',
            'status_murid' => $this->statusMuridModel->getStatusMurid(),
            'program_belajar' => $this->programBelajarModel->getProgramBelajar(),
            'materi_belajar' => $this->materiBelajarModel->getMateriBelajar(),
            'data_murid' => $data_murid,
            'paket_belajar' => $this->paketBelajarModel->getPaketBelajar(),

        ];

        return view('mitra/murid_v', $data);
    }

    public function view($id)
    {


        if ($id == null) {
            return redirect()->to('/admin/data_murid');
        }

        $profil = $this->muridModel->getMitramurid($id);
        // dd($profil);

        // dd($profil);
        $hari_ini = date_create();
        $tanggal_lahir = date_create($profil->tanggal_lahir_anak);

        $usia = date_diff($hari_ini, $tanggal_lahir);


        if ($profil == null) {
            return redirect()->to('/admin/data_murid');
        }

        $data = [
            'title' => 'Peserta Didik',
            'profil' => $profil,
            'usia' => $usia
        ];

        return view('mitra/profil_murid_v', $data);
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $murid = $this->muridModel->where(["id" => $id])->first();
            $program_belajar = $this->programBelajarModel->getProgramBelajar();
            $materi_belajar = $this->materiBelajarModel->getMateriBelajar();
            $paket_belajar = $this->paketBelajarModel->getPaketBelajar();
            $pendidikan = $this->tingkatPendidikanModel->getPendidikan();

            $data = [
                'murid' => $murid,
                'program_belajar' => $program_belajar,
                'paket_belajar' => $paket_belajar,
                'materi_belajar' => $materi_belajar,
                'pendidikan' => $pendidikan
            ];

            return json_encode($data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'ketersediaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'nama_panggilan_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'jenis_kelamin' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'pendidikan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'ukuran_baju' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'catatan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'izin_dokumentasi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'tata_tertib' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'tindak_lanjut' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'larangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'data_1' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'data_2' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'nama_lengkap_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lengkap Tidak Boleh Kosong !'
                    ]
                ],
                'tanggal_lahir_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Lahir Tidak Boleh Kosong !',

                    ]
                ],

                'alamat_domisili_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat Domisili  Tidak Boleh Kosong !'
                    ]
                ],
                'sekolah_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Sekolah Tidak Boleh Kosong !'
                    ]
                ],
                'riwayat_penyakit' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Riwayat Penyakit Tidak Boleh Kosong !'
                    ]
                ],
                'nomor_whatsapp_wali' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Whatsapp Wali Tidak Boleh Kosong !'
                    ]
                ],
                'username_instagram_wali' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username Instagram Tidak Boleh Kosong !'
                    ]
                ],
                'paket_belajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Paket Belajar Tidak Boleh Kosong !'
                    ]
                ],
                'program_belajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Program Belajar  Tidak Boleh Kosong !'
                    ]
                ],
                'materi_belajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Materi Belajar  Tidak Boleh Kosong !'
                    ]
                ],
                'hari_belajar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Hari Tidak Boleh Kosong!'
                    ]
                ],

                'waktu_belajar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Waktu Tidak Boleh Kosong !'
                    ]
                ],

                'nama_ayah' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'nama_ibu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'pekerjaan_ibu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'agama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'pekerjaan_ayah' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],

                'info_les' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_lengkap_anak' => $this->validation->getError('nama_lengkap_anak'),
                        'tanggal_lahir_anak' => $this->validation->getError('tanggal_lahir_anak'),
                        'alamat_domisili_anak' => $this->validation->getError('alamat_domisili_anak'),
                        'sekolah_anak' => $this->validation->getError('sekolah_anak'),
                        'nomor_whatsapp_wali' => $this->validation->getError('nomor_whatsapp_wali'),
                        'username_instagram_wali' => $this->validation->getError('username_instagram_wali'),
                        'paket_belajar_id' => $this->validation->getError('paket_belajar_id'),
                        'program_belajar_id' => $this->validation->getError('program_belajar_id'),
                        'materi_belajar_id' => $this->validation->getError('materi_belajar_id'),
                        'hari_belajar' => $this->validation->getError('hari_belajar'),
                        'waktu_belajar' => $this->validation->getError('waktu_belajar'),
                        'info_les' => $this->validation->getError('info_les'),
                        'nama_ayah' => $this->validation->getError('nama_ayah'),
                        'nama_ibu' => $this->validation->getError('nama_ibu'),
                        'pekerjaan_ayah' => $this->validation->getError('pekerjaan_ayah'),
                        'pekerjaan_ibu' => $this->validation->getError('pekerjaan_ibu'),
                        'agama' => $this->validation->getError('agama'),
                        'ketersediaan' => $this->validation->getError('ketersediaan'),
                        'nama_panggilan_anak' => $this->validation->getError('nama_panggilan_anak'),
                        'jenis_kelamin' => $this->validation->getError('jenis_kelamin'),
                        'pendidikan_id' => $this->validation->getError('pendidikan_id'),
                        'ukuran_baju' => $this->validation->getError('ukuran_baju'),
                        'catatan' => $this->validation->getError('catatan'),
                        'riwayat_penyakit' => $this->validation->getError('riwayat_penyakit'),
                        'izin_dokumentasi' => $this->validation->getError('izin_dokumentasi'),
                        'tata_tertib' => $this->validation->getError('tata_tertib'),
                        'tindak_lanjut' => $this->validation->getError('tindak_lanjut'),
                        'larangan' => $this->validation->getError('larangan'),
                        'data_1' => $this->validation->getError('data_1'),
                        'data_2' => $this->validation->getError('data_2'),
                    ]
                ];
            } else {

                $id = $this->request->getVar('id');
                $foto_lama = $this->request->getVar('foto_lama');
                $bukti_tf_lama = $this->request->getVar('bukti_tf_lama');

                $regMurid = $this->muridModel->where(["id" => $id])->first();
                $uid_murid = $this->muridModel->countAllResults();

                $nama_lengkap_anak = $this->request->getPost('nama_lengkap_anak');
                $tanggal_lahir_anak = $this->request->getPost('tanggal_lahir_anak');

                $alamat_domisili_anak = $this->request->getPost('alamat_domisili_anak');
                $sekolah_anak = $this->request->getPost('sekolah_anak');
                $nomor_whatsapp_wali = $this->request->getPost('nomor_whatsapp_wali');
                $username_instagram_wali = $this->request->getPost('username_instagram_wali');
                $program_belajar_id = $this->request->getPost('program_belajar_id');
                $materi_belajar_id = $this->request->getPost('materi_belajar_id');
                $hari_belajar = $this->request->getPost('hari_belajar');
                $waktu_belajar = $this->request->getPost('waktu_belajar');
                $riwayat_penyakit = $this->request->getPost('riwayat_penyakit');

                $info_les = $this->request->getPost('info_les');

                $nama_ibu = $this->request->getPost('nama_ibu');
                $nama_ayah = $this->request->getPost('nama_ayah');
                $pekerjaan_ayah = $this->request->getPost('pekerjaan_ayah');
                $pekerjaan_ibu = $this->request->getPost('pekerjaan_ibu');
                $agama = $this->request->getPost('agama');

                $paket_belajar_id = $this->request->getPost('paket_belajar_id');
                $ketersediaan = $this->request->getPost('ketersediaan');
                $nama_panggilan_anak = $this->request->getPost('nama_panggilan_anak');
                $jenis_kelamin = $this->request->getPost('jenis_kelamin');
                $pendidikan_id = $this->request->getPost('pendidikan_id');
                $ukuran_baju = $this->request->getPost('ukuran_baju');
                $catatan = $this->request->getPost('catatan');
                $izin_dokumentasi = $this->request->getPost('izin_dokumentasi');
                $tata_tertib = $this->request->getPost('tata_tertib');
                $tindak_lanjut = $this->request->getPost('tindak_lanjut');
                $larangan = $this->request->getPost('larangan');
                $data_1 = $this->request->getPost('data_1');
                $data_2 = $this->request->getPost('data_2');

                $bukti_tf = $this->request->getFile('bukti_tf');

                $path_bukti_tf = 'bukti_tf_private/' . $bukti_tf_lama;

                if ($bukti_tf->getError() == 4) {
                    if ($bukti_tf_lama != null) {
                        $nama_tf = $bukti_tf_lama;
                    } else {
                        $nama_tf = 'NULL';
                    }
                } else {
                    if ($bukti_tf_lama != null) {
                        if (file_exists($path_bukti_tf)) {
                            unlink($path_bukti_tf);
                        }
                    }
                    $nama_tf = $bukti_tf->getRandomName();
                    $bukti_tf->move('bukti_tf_private', $nama_tf);
                }


                $foto_anak = $this->request->getFile('foto_anak');

                $path_foto_lama = 'foto_profil_anak/' . $foto_lama;

                if ($foto_anak->getError() == 4) {
                    $nama_foto = $foto_lama;
                } else {
                    if (file_exists($path_foto_lama)) {
                        unlink($path_foto_lama);
                    }
                    $nama_foto = $foto_anak->getRandomName();
                    $foto_anak->move('foto_profil_anak', $nama_foto);
                }

                $this->muridModel->update($id, [
                    'uid_murid' => $uid_murid,
                    'nama_lengkap_anak' => strtolower($nama_lengkap_anak),
                    'tanggal_lahir_anak' => strtolower($tanggal_lahir_anak),
                    'alamat_domisili_anak' => strtolower($alamat_domisili_anak),
                    'sekolah_anak' => strtolower($sekolah_anak),
                    'nomor_whatsapp_wali' => strtolower($nomor_whatsapp_wali),
                    'username_instagram_wali' => strtolower($username_instagram_wali),
                    'paket_belajar_id' => strtolower($paket_belajar_id),
                    'program_belajar_id' => strtolower($program_belajar_id),
                    'materi_belajar_id' => strtolower($materi_belajar_id),
                    'hari_belajar' => strtolower($hari_belajar),
                    'waktu_belajar' => strtolower($waktu_belajar),
                    'riwayat_penyakit' => strtolower($riwayat_penyakit),
                    'nama_ayah' => strtolower($nama_ayah),
                    'nama_ibu' => strtolower($nama_ibu),
                    'pekerjaan_ayah' => strtolower($pekerjaan_ayah),
                    'pekerjaan_ibu' => strtolower($pekerjaan_ibu),
                    'agama' => strtolower($agama),
                    'info_les' => $info_les,
                    'foto_anak' => strtolower($nama_foto),
                    'bukti_tf' => strtolower($nama_tf),
                    'ketersediaan' => strtolower($ketersediaan),
                    'nama_panggilan_anak' => strtolower($nama_panggilan_anak),
                    'jenis_kelamin' => strtolower($jenis_kelamin),
                    'pendidikan_id' => strtolower($pendidikan_id),
                    'ukuran_baju' => strtolower($ukuran_baju),
                    'catatan' => strtolower($catatan),
                    'izin_dokumentasi' => strtolower($izin_dokumentasi),
                    'tata_tertib' => strtolower($tata_tertib),
                    'tindak_lanjut' => strtolower($tindak_lanjut),
                    'larangan' => strtolower($larangan),
                    'data_1' => strtolower($data_1),
                    'data_2' => strtolower($data_2),
                ]);

                $alert = [
                    'success' => 'Data murid Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function peserta_didik()
    {

        $session_mitra = session('mitra_pengajar_id');

        $pembimbing = $this->pembimbingModel->where(["mitra_pengajar_id" => $session_mitra])->first();

        if ($pembimbing != null) {
            $data = [
                'title' => 'Peserta Didik',
                'status_murid' => $this->statusMuridModel->getStatusMurid(),
                'program_belajar' => $this->programBelajarModel->getProgramBelajar(),
                'materi_belajar' => $this->materiBelajarModel->getMateriBelajar(),
                'data_murid' => $this->muridModel->getDataMurid(),
                'paket_belajar' => $this->paketBelajarModel->getPaketBelajar(),

            ];

            return view('mitra/murid_private_v', $data);
        } else {
            return redirect()->back();
        }
    }
}
