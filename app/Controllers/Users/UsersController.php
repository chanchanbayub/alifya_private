<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\Admin\MateriBelajarModel;
use App\Models\Admin\MuridModel;
use App\Models\Admin\PaketBelajarModel;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\ProgramBelajarModel;
use App\Models\Admin\TestimonialModel;
use App\Models\Ahl\PesertaDidikAhlModel;
use App\Models\Ahl\ProgramAHLModel;
use App\Models\Ahl\TinggalPendidikanModel;
use App\Models\Ahl\TingkatPendidikanModel;
use CodeIgniter\HTTP\ResponseInterface;

class UsersController extends BaseController
{
    protected $pengajarModel;
    protected $dataPendukungModel;
    protected $programBelajarModel;
    protected $materiBelajarModel;
    protected $dataPendukungMuridModel;
    protected $validation;
    protected $paketBelajarModel;
    protected $testimonialModel;
    protected $muridModel;
    protected $programAHLModel;
    protected $pesertaDidikAhlModel;
    protected $tingkatPendidikanModel;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->validation = \Config\Services::validation();
        $this->programBelajarModel = new ProgramBelajarModel();
        $this->materiBelajarModel = new MateriBelajarModel();
        $this->muridModel = new MuridModel();
        $this->paketBelajarModel = new PaketBelajarModel();
        $this->testimonialModel = new TestimonialModel();
        $this->programAHLModel = new ProgramAHLModel();
        $this->pesertaDidikAhlModel = new PesertaDidikAhlModel();
        $this->tingkatPendidikanModel = new TingkatPendidikanModel();
    }

    public function index()
    {
        $program_belajar = $this->programBelajarModel->getProgramBelajar();
        $paketBelajar = $this->paketBelajarModel->getPaketBelajar();
        $data_pengajar = $this->pengajarModel->getDatPengajarLimitData();
        $testimonial = $this->testimonialModel->getTestimonial();
        $data_slidder = $this->testimonialModel->getTestimonial();

        $data = [
            'title' => 'Alifya Private',
            'program_belajar' => $program_belajar,
            'paket_belajar' => $paketBelajar,
            'data_pengajar' => $data_pengajar,
            'testimonial' => $testimonial,
            'slidder' => $data_slidder

        ];
        return view('users/home_v', $data);
    }

    public function mitra_pengajar()
    {
        $data = [
            'title' => 'Alifya Private | Mitra Pengajar',
            'mitra_pengajar' => $this->pengajarModel->getDataPengajarStatusAktif()
        ];
        return view('users/mitra_pengajar_v', $data);
    }

    public function peserta_didik()
    {
        $data = [
            'title' => 'Alifya Private | Peserta Didik',
            'peserta_didik' => $this->muridModel->getDataMuridAktif()
        ];
        return view('users/peserta_didik_v', $data);
    }

    public function daftar_mitra()
    {
        $data = [
            'title' => 'Alifya Private | Daftar Mitra',

        ];
        return view('users/daftar_mitra_v', $data);
    }

    public function daftar_mitra_pengajar()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lengkap Tidak Boleh Kosong !'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email Tidak Boleh Kosong !',
                        'valid_email' => 'Email yang Anda Masukan Tidak Valid'
                    ]
                ],
                'usia' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'usia Tidak Boleh Kosong !'
                    ]
                ],
                'tanggal_lahir_mitra' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Lahir Tidak Boleh Kosong !'
                    ]
                ],
                'alamat_domisili' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat Domisili Tidak Boleh Kosong !'
                    ]
                ],
                'pendidikan_terakhir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pendidikan Terakhir Tidak Boleh Kosong !'
                    ]
                ],
                'jurusan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jurusan Tidak Boleh Kosong !'
                    ]
                ],
                'status_perkawinan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Perkawinan Tidak Boleh Kosong !'
                    ]
                ],
                'nomor_whatsapp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Whatsapp Tidak Boleh Kosong !'
                    ]
                ],
                'username_instagram' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username Tidak Boleh Kosong !'
                    ]
                ],

                'pekerjaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pekerjaan Tidak Boleh Kosong !'
                    ]
                ],
                'kontrak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'pernyataan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'kendaraan_pribadi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'media_belajar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'alasan_bergabung' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'kelebihan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'info_loker' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/png,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'Foto Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],

                'cv' => [
                    'rules' => 'uploaded[cv]|max_size[cv,2048]',
                    'errors' => [
                        'uploaded' => 'CV Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',

                    ]
                ],

                'ijazah' => [
                    'rules' => 'uploaded[ijazah]|max_size[ijazah,2048]',
                    'errors' => [
                        'uploaded' => 'Ijazah Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_lengkap' => $this->validation->getError('nama_lengkap'),
                        'email' => $this->validation->getError('email'),
                        'usia' => $this->validation->getError('usia'),
                        'tanggal_lahir_mitra' => $this->validation->getError('tanggal_lahir_mitra'),
                        'alamat_domisili' => $this->validation->getError('alamat_domisili'),
                        'pendidikan_terakhir' => $this->validation->getError('pendidikan_terakhir'),
                        'jurusan' => $this->validation->getError('jurusan'),
                        'status_perkawinan' => $this->validation->getError('status_perkawinan'),
                        'nomor_whatsapp' => $this->validation->getError('nomor_whatsapp'),
                        'username_instagram' => $this->validation->getError('username_instagram'),
                        'foto' => $this->validation->getError('foto'),
                        'cv' => $this->validation->getError('cv'),
                        'ijazah' => $this->validation->getError('ijazah'),
                        'pekerjaan' => $this->validation->getError('pekerjaan'),
                        'kontrak' => $this->validation->getError('kontrak'),
                        'pernyataan' => $this->validation->getError('pernyataan'),
                        'kendaraan_pribadi' => $this->validation->getError('kendaraan_pribadi'),
                        'media_belajar' => $this->validation->getError('media_belajar'),
                        'alasan_bergabung' => $this->validation->getError('alasan_bergabung'),
                        'kelebihan' => $this->validation->getError('kelebihan'),
                        'info_loker' => $this->validation->getError('info_loker'),
                    ]
                ];
            } else {

                $regIdMitra = $this->pengajarModel->countAllResults();

                $uid = $regIdMitra + 1;
                $nama_lengkap = $this->request->getPost('nama_lengkap');
                $email = $this->request->getPost('email');
                $usia = $this->request->getPost('usia');
                $tanggal_lahir_mitra = $this->request->getPost('tanggal_lahir_mitra');
                $alamat_domisili = $this->request->getPost('alamat_domisili');
                $pendidikan_terakhir = $this->request->getPost('pendidikan_terakhir');
                $jurusan = $this->request->getPost('jurusan');
                $status_perkawinan = $this->request->getPost('status_perkawinan');
                $nomor_whatsapp = $this->request->getPost('nomor_whatsapp');
                $username_instagram = $this->request->getPost('username_instagram');

                $foto = $this->request->getFile('foto');
                $cv = $this->request->getFile('cv');
                $ijazah = $this->request->getFile('ijazah');

                $pekerjaan = $this->request->getPost('pekerjaan');
                $kontrak = $this->request->getPost('kontrak');
                $pernyataan = $this->request->getPost('pernyataan');
                $kendaraan_pribadi = $this->request->getPost('kendaraan_pribadi');
                $media_belajar = $this->request->getPost('media_belajar');
                $alasan_bergabung = $this->request->getPost('alasan_bergabung');
                $kelebihan = $this->request->getPost('kelebihan');
                $info_loker = $this->request->getPost('info_loker');

                $nama_foto = $foto->getRandomName();
                $nama_cv = $cv->getRandomName();
                $nama_ijazah = $ijazah->getRandomName();

                $status_id = 2;

                $this->pengajarModel->save([
                    'uid' => $uid,
                    'nama_lengkap' => strtolower($nama_lengkap),
                    'email' => strtolower($email),
                    'usia' => strtolower($usia),
                    'tanggal_lahir_mitra' => strtolower($tanggal_lahir_mitra),
                    'alamat_domisili' => strtolower($alamat_domisili),
                    'pendidikan_terakhir' => strtolower($pendidikan_terakhir),
                    'jurusan' => strtolower($jurusan),
                    'status_perkawinan' => strtolower($status_perkawinan),
                    'nomor_whatsapp' => strtolower($nomor_whatsapp),
                    'username_instagram' => strtolower($username_instagram),
                    'pekerjaan' => strtolower($pekerjaan),
                    'kontrak' => strtolower($kontrak),
                    'pernyataan' => strtolower($pernyataan),
                    'kendaraan_pribadi' => strtolower($kendaraan_pribadi),
                    'media_belajar' => strtolower($media_belajar),
                    'alasan_bergabung' => strtolower($alasan_bergabung),
                    'kelebihan' => strtolower($kelebihan),
                    'info_loker' => strtolower($info_loker),
                    'ijazah' => strtolower($nama_ijazah),
                    'foto' => strtolower($nama_foto),
                    'cv' => strtolower($nama_cv),
                    'status_id' => strtolower($status_id),

                ]);

                $foto->move('foto_profil', $nama_foto);
                $cv->move('cv_file', $nama_cv);
                $ijazah->move('ijazah', $nama_ijazah);

                $alert = [
                    'success' => 'Data Pengajar Berhasil di Simpan !, Silahkan Tunggu Konfirmasi Admin, Terima Kasih!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function daftar_peserta_didik()
    {
        $data = [
            'title' => 'Alifya Private | Peserta Didik',
            'program_belajar' => $this->programBelajarModel->getProgramBelajar(),
            'materi_belajar' => $this->materiBelajarModel->getMateriBelajar(),
            'paket_belajar' => $this->paketBelajarModel->getPaketBelajar()
        ];
        return view('users/daftar_peserta_didik_v', $data);
    }

    public function daftar_peserta()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
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
                'usia_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Usia Tidak Boleh Kosong !'
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
                'pekerjaan_ayah' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'foto_anak' => [
                    'rules' => 'uploaded[foto_anak]|max_size[foto_anak,2048]|is_image[foto_anak]|mime_in[foto_anak,image/png,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'Foto Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],

                'info_les' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],

                'brosur' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'data' => [
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
                        'usia_anak' => $this->validation->getError('usia_anak'),
                        'alamat_domisili_anak' => $this->validation->getError('alamat_domisili_anak'),
                        'sekolah_anak' => $this->validation->getError('sekolah_anak'),
                        'nomor_whatsapp_wali' => $this->validation->getError('nomor_whatsapp_wali'),
                        'username_instagram_wali' => $this->validation->getError('username_instagram_wali'),
                        'paket_belajar_id' => $this->validation->getError('paket_belajar_id'),
                        'program_belajar_id' => $this->validation->getError('program_belajar_id'),
                        'materi_belajar_id' => $this->validation->getError('materi_belajar_id'),
                        'hari_belajar' => $this->validation->getError('hari_belajar'),
                        'waktu_belajar' => $this->validation->getError('waktu_belajar'),
                        'foto_anak' => $this->validation->getError('foto_anak'),
                        'info_les' => $this->validation->getError('info_les'),
                        'brosur' => $this->validation->getError('brosur'),
                        'data' => $this->validation->getError('data'),
                        'nama_ayah' => $this->validation->getError('nama_ayah'),
                        'nama_ibu' => $this->validation->getError('nama_ibu'),
                        'pekerjaan_ayah' => $this->validation->getError('pekerjaan_ayah'),
                        'pekerjaan_ibu' => $this->validation->getError('pekerjaan_ibu'),
                    ]
                ];
            } else {

                $countUid = $this->muridModel->countAllResults();
                $uid_murid = $countUid + 1;

                $nama_lengkap_anak = $this->request->getPost('nama_lengkap_anak');
                $tanggal_lahir_anak = $this->request->getPost('tanggal_lahir_anak');
                $usia_anak = $this->request->getPost('usia_anak');
                $alamat_domisili_anak = $this->request->getPost('alamat_domisili_anak');
                $sekolah_anak = $this->request->getPost('sekolah_anak');
                $nomor_whatsapp_wali = $this->request->getPost('nomor_whatsapp_wali');
                $username_instagram_wali = $this->request->getPost('username_instagram_wali');
                $program_belajar_id = $this->request->getPost('program_belajar_id');
                $materi_belajar_id = $this->request->getPost('materi_belajar_id');
                $hari_belajar = $this->request->getPost('hari_belajar');
                $waktu_belajar = $this->request->getPost('waktu_belajar');

                $foto_anak = $this->request->getFile('foto_anak');

                $nama_foto = $foto_anak->getRandomName();

                $status_murid_id = 3;
                $brosur = $this->request->getPost('brosur');
                $info_les = $this->request->getPost('info_les');
                $data = $this->request->getPost('data');

                $nama_ibu = $this->request->getPost('nama_ibu');
                $nama_ayah = $this->request->getPost('nama_ayah');
                $pekerjaan_ayah = $this->request->getPost('pekerjaan_ayah');
                $pekerjaan_ibu = $this->request->getPost('pekerjaan_ibu');

                $paket_belajar_id = $this->request->getPost('paket_belajar_id');


                $this->muridModel->save([
                    'uid_murid' => $uid_murid,
                    'nama_lengkap_anak' => strtolower($nama_lengkap_anak),
                    'tanggal_lahir_anak' => strtolower($tanggal_lahir_anak),
                    'usia_anak' => strtolower($usia_anak),
                    'alamat_domisili_anak' => strtolower($alamat_domisili_anak),
                    'sekolah_anak' => strtolower($sekolah_anak),
                    'nomor_whatsapp_wali' => strtolower($nomor_whatsapp_wali),
                    'username_instagram_wali' => strtolower($username_instagram_wali),
                    'paket_belajar_id' => strtolower($paket_belajar_id),
                    'program_belajar_id' => strtolower($program_belajar_id),
                    'materi_belajar_id' => strtolower($materi_belajar_id),
                    'hari_belajar' => strtolower($hari_belajar),
                    'waktu_belajar' => strtolower($waktu_belajar),
                    'nama_ayah' => strtolower($nama_ayah),
                    'nama_ibu' => strtolower($nama_ibu),
                    'pekerjaan_ayah' => strtolower($pekerjaan_ayah),
                    'pekerjaan_ibu' => strtolower($pekerjaan_ibu),
                    'brosur' => $brosur,
                    'info_les' => $info_les,
                    'data' => $data,
                    'foto_anak' => strtolower($nama_foto),
                    'status_murid_id' => $status_murid_id,

                ]);

                $foto_anak->move('foto_profil_anak', $nama_foto);

                $alert = [
                    'success' => 'Data Berhasil Tersimpan, Silahkan Tunggu informasi dari admin, Terima kasih!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function daftar_ahl()
    {
        $data = [
            'title' => 'Alifya Home Learning | Daftar AHL',
            'peserta_didik' => $this->muridModel->getDataMuridAktif(),
            'program_ahl' => $this->programAHLModel->getProgramAHL(),
            'pendidikan' => $this->tingkatPendidikanModel->getPendidikan()

        ];
        return view('users/daftar_peserta_ahl', $data);
    }

    public function daftar_peserta_ahl()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'ketersediaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih Salah Satu'
                    ]
                ],
                // data orang tua
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
                'pekerjaan_ayah' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'usersname_instagram' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'nomor_whatsapp_orang_tua' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'alamat_domisili_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],

                // data murid
                'nama_lengkap_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !',
                    ]
                ],
                'nama_panggilan_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !',
                    ]
                ],
                'tanggal_lahir_anak' => [
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
                'sekolah_anak' => [
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

                'program_belajar_ahl_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],


                'foto_anak' => [
                    'rules' => 'uploaded[foto_anak]|max_size[foto_anak,2048]|is_image[foto_anak]|mime_in[foto_anak,image/png,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'Foto Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],
                'bukti_tf' => [
                    'rules' => 'uploaded[bukti_tf]|max_size[bukti_tf,2048]|is_image[bukti_tf]|mime_in[bukti_tf,image/png,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'Foto Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],

                'izin_dokumentasi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih Salah Satu'
                    ]
                ],

                'info_alifya' => [
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



            ])) {
                $alert = [
                    'error' => [
                        'ketersediaan' => $this->validation->getError('ketersediaan'),
                        // data orang_tua
                        'nama_ayah' => $this->validation->getError('nama_ayah'),
                        'pekerjaan_ayah' => $this->validation->getError('pekerjaan_ayah'),

                        'nama_ibu' => $this->validation->getError('nama_ibu'),
                        'pekerjaan_ibu' => $this->validation->getError('pekerjaan_ibu'),
                        'usersname_instagram' => $this->validation->getError('usersname_instagram'),
                        'nomor_whatsapp_orang_tua' => $this->validation->getError('nomor_whatsapp_orang_tua'),
                        'alamat_domisili_anak' => $this->validation->getError('alamat_domisili_anak'),

                        'nama_lengkap_anak' => $this->validation->getError('nama_lengkap_anak'),
                        'nama_panggilan_anak' => $this->validation->getError('nama_panggilan_anak'),
                        'tanggal_lahir_anak' => $this->validation->getError('tanggal_lahir_anak'),
                        'jenis_kelamin' => $this->validation->getError('jenis_kelamin'),
                        'pendidikan_id' => $this->validation->getError('pendidikan_id'),
                        'sekolah_anak' => $this->validation->getError('sekolah_anak'),
                        'ukuran_baju' => $this->validation->getError('ukuran_baju'),

                        'program_belajar_ahl_id' => $this->validation->getError('program_belajar_ahl_id'),
                        'foto_anak' => $this->validation->getError('foto_anak'),
                        'bukti_tf' => $this->validation->getError('bukti_tf'),

                        'izin_dokumentasi' => $this->validation->getError('izin_dokumentasi'),
                        'info_alifya' => $this->validation->getError('info_alifya'),
                        'data_1' => $this->validation->getError('data_1'),
                        'data_2' => $this->validation->getError('data_2'),


                    ]
                ];
            } else {

                $ketersediaan = $this->request->getPost('ketersediaan');

                // data orang tua
                $nama_ibu = $this->request->getPost('nama_ibu');
                $nama_ayah = $this->request->getPost('nama_ayah');
                $pekerjaan_ayah = $this->request->getPost('pekerjaan_ayah');
                $pekerjaan_ibu = $this->request->getPost('pekerjaan_ibu');
                $usersname_instagram = $this->request->getPost('usersname_instagram');
                $nomor_whatsapp_orang_tua = $this->request->getPost('nomor_whatsapp_orang_tua');
                $alamat_domisili_anak = $this->request->getPost('alamat_domisili_anak');

                $nama_lengkap_anak = $this->request->getPost('nama_lengkap_anak');
                $nama_panggilan_anak = $this->request->getPost('nama_panggilan_anak');
                $tanggal_lahir_anak = $this->request->getPost('tanggal_lahir_anak');
                $jenis_kelamin = $this->request->getPost('jenis_kelamin');
                $pendidikan_id = $this->request->getPost('pendidikan_id');
                $sekolah_anak = $this->request->getPost('sekolah_anak');
                $ukuran_baju = $this->request->getPost('ukuran_baju');

                $program_belajar_ahl_id = $this->request->getPost('program_belajar_ahl_id');

                $foto_anak = $this->request->getFile('foto_anak');
                $nama_foto = $foto_anak->getRandomName();

                $bukti_tf = $this->request->getFile('bukti_tf');
                $nama_foto_tf = $bukti_tf->getRandomName();

                $izin_dokumentasi = $this->request->getPost('izin_dokumentasi');
                $info_alifya = $this->request->getPost('info_alifya');
                $data_1 = $this->request->getPost('data_1');
                $data_2 = $this->request->getPost('data_2');

                $status_peserta_id = 3;

                $this->pesertaDidikAhlModel->save([
                    'ketersediaan' => strtolower($ketersediaan),
                    'nama_ayah' => strtolower($nama_ayah),
                    'pekerjaan_ayah' => strtolower($pekerjaan_ayah),
                    'nama_ibu' => strtolower($nama_ibu),
                    'pekerjaan_ibu' => strtolower($pekerjaan_ibu),
                    'usersname_instagram' => strtolower($usersname_instagram),
                    'nomor_whatsapp_orang_tua' => strtolower($nomor_whatsapp_orang_tua),
                    'alamat_domisili_anak' => strtolower($alamat_domisili_anak),
                    'nama_lengkap_anak' => strtolower($nama_lengkap_anak),
                    'nama_panggilan_anak' => strtolower($nama_panggilan_anak),
                    'tanggal_lahir_anak' => strtolower($tanggal_lahir_anak),
                    'jenis_kelamin' => strtolower($jenis_kelamin),
                    'pendidikan_id' => strtolower($pendidikan_id),
                    'sekolah_anak' => strtolower($sekolah_anak),
                    'ukuran_baju' => strtolower($ukuran_baju),
                    'program_belajar_ahl_id' => strtolower($program_belajar_ahl_id),
                    'foto_anak' => $nama_foto,
                    'bukti_tf' => $nama_foto_tf,
                    'izin_dokumentasi' => strtolower($izin_dokumentasi),
                    'info_alifya' => strtolower($info_alifya),
                    'data_1' => strtolower($data_1),
                    'data_2' => strtolower($data_2),
                    'status_peserta_id' => strtolower($status_peserta_id),
                    'tanggal_bergabung' => date('Y-m-d')
                ]);

                $foto_anak->move('foto_profil_anak_ahl', $nama_foto);
                $bukti_tf->move('bukti_tf', $nama_foto_tf);

                $alert = [
                    'success' => 'Data Berhasil Tersimpan, Silahkan Tunggu informasi dari admin, Terima kasih!'
                ];
            }

            return json_encode($alert);
        }
    }
}
