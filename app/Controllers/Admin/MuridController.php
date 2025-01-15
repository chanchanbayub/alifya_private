<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HariModel;
use App\Models\Admin\MateriBelajarModel;
use App\Models\Admin\MuridModel;
use App\Models\Admin\PaketBelajarModel;
use App\Models\Admin\ProgramBelajarModel;
use App\Models\Admin\StatusMuridModel;
use App\Models\Admin\WaktuModel;
use CodeIgniter\HTTP\ResponseInterface;

class MuridController extends BaseController
{
    protected $muridModel;
    protected $statusMuridModel;
    protected $programBelajarModel;
    protected $materiBelajarModel;
    protected $paketBelajarModel;

    protected $validation;

    public function __construct()
    {
        $this->muridModel = new MuridModel();
        $this->statusMuridModel = new StatusMuridModel();
        $this->programBelajarModel = new ProgramBelajarModel();
        $this->materiBelajarModel = new MateriBelajarModel();
        $this->validation = \Config\Services::validation();
        $this->paketBelajarModel = new PaketBelajarModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Peserta Didik',
            'status_murid' => $this->statusMuridModel->getStatusMurid(),
            'program_belajar' => $this->programBelajarModel->getProgramBelajar(),
            'materi_belajar' => $this->materiBelajarModel->getMateriBelajar(),
            'data_murid' => $this->muridModel->getDataMurid(),
            'paket_belajar' => $this->paketBelajarModel->getPaketBelajar(),
        ];

        return view('admin/murid_v', $data);
    }

    public function getMateriBelajar()
    {
        if ($this->request->isAJAX()) {

            $program_belajar_id = $this->request->getVar('program_belajar_id');
            $materi_belajar = $this->materiBelajarModel->getMateriBelajarWithProgramBelajarId($program_belajar_id);

            $data = [
                'materi_belajar' => $materi_belajar,
            ];

            return json_encode($data);
        }
    }

    public function insert()
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
                'nama_ayah' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Ayah Tidak Boleh Kosong !'
                    ]
                ],
                'pekerjaan_ayah' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pekerjaan Ayah Tidak Boleh Kosong !'
                    ]
                ],
                'nama_ibu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Ibu Tidak Boleh Kosong !'
                    ]
                ],
                'pekerjaan_ibu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pekerjaan Ibu Tidak Boleh Kosong !'
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
                'info_les' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Informasi Les Tidak Boleh Kosong !'
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
                        'required' => 'Program Belajar  Tidak Boleh Kosong !'
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
                'foto_anak' => [
                    'rules' => 'uploaded[foto_anak]|max_size[foto_anak,5048]|is_image[foto_anak]|mime_in[foto_anak,image/png,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'Foto Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],

                'status_murid_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Murid Tidak Boleh Kosong !'
                    ]
                ],
                'brosur' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Info Harga Tidak Boleh Kosong !'
                    ]
                ],
                'data' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Persetujuan Tidak Boleh Kosong !'
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
                        'nama_ayah' => $this->validation->getError('nama_ayah'),
                        'pekerjaan_ayah' => $this->validation->getError('pekerjaan_ayah'),
                        'nama_ibu' => $this->validation->getError('nama_ibu'),
                        'pekerjaan_ibu' => $this->validation->getError('pekerjaan_ibu'),
                        'nomor_whatsapp_wali' => $this->validation->getError('nomor_whatsapp_wali'),
                        'username_instagram_wali' => $this->validation->getError('username_instagram_wali'),
                        'info_les' => $this->validation->getError('info_les'),
                        'paket_belajar_id' => $this->validation->getError('paket_belajar_id'),
                        'program_belajar_id' => $this->validation->getError('program_belajar_id'),
                        'materi_belajar_id' => $this->validation->getError('materi_belajar_id'),
                        'hari_belajar' => $this->validation->getError('hari_belajar'),
                        'waktu_belajar' => $this->validation->getError('waktu_belajar'),
                        'foto_anak' => $this->validation->getError('foto_anak'),
                        'status_murid_id' => $this->validation->getError('status_murid_id'),
                        'brosur' => $this->validation->getError('brosur'),
                        'data' => $this->validation->getError('data'),
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
                $nama_ayah = $this->request->getPost('nama_ayah');
                $pekerjaan_ayah = $this->request->getPost('pekerjaan_ayah');
                $nama_ibu = $this->request->getPost('nama_ibu');
                $pekerjaan_ibu = $this->request->getPost('pekerjaan_ibu');
                $nomor_whatsapp_wali = $this->request->getPost('nomor_whatsapp_wali');
                $username_instagram_wali = $this->request->getPost('username_instagram_wali');
                $info_les = $this->request->getPost('info_les');
                $paket_belajar_id = $this->request->getPost('paket_belajar_id');
                $program_belajar_id = $this->request->getPost('program_belajar_id');
                $materi_belajar_id = $this->request->getPost('materi_belajar_id');
                $hari_belajar = $this->request->getPost('hari_belajar');
                $waktu_belajar = $this->request->getPost('waktu_belajar');

                $foto_anak = $this->request->getFile('foto_anak');
                $status_murid_id = $this->request->getPost('status_murid_id');

                $nama_foto = $foto_anak->getRandomName();

                $status_murid_id = $this->request->getPost('status_murid_id');
                $brosur = $this->request->getPost('brosur');
                $data = $this->request->getPost('data');

                $this->muridModel->save([
                    'uid_murid' => $uid_murid,
                    'nama_lengkap_anak' => strtolower($nama_lengkap_anak),
                    'tanggal_lahir_anak' => strtolower($tanggal_lahir_anak),
                    'usia_anak' => strtolower($usia_anak),
                    'alamat_domisili_anak' => strtolower($alamat_domisili_anak),
                    'sekolah_anak' => strtolower($sekolah_anak),
                    'nama_ayah' => strtolower($nama_ayah),
                    'pekerjaan_ayah' => strtolower($pekerjaan_ayah),
                    'nama_ibu' => strtolower($nama_ibu),
                    'pekerjaan_ibu' => strtolower($pekerjaan_ibu),
                    'nomor_whatsapp_wali' => strtolower($nomor_whatsapp_wali),
                    'username_instagram_wali' => strtolower($username_instagram_wali),
                    'info_les' => strtolower($info_les),
                    'paket_belajar_id' => strtolower($paket_belajar_id),
                    'program_belajar_id' => strtolower($program_belajar_id),
                    'materi_belajar_id' => strtolower($materi_belajar_id),
                    'hari_belajar' => strtolower($hari_belajar),
                    'waktu_belajar' => strtolower($waktu_belajar),
                    'foto_anak' => strtolower($nama_foto),
                    'status_murid_id' => strtolower($status_murid_id),
                    'data' => strtolower($data),
                    'brosur' => strtolower($brosur),

                ]);

                $foto_anak->move('foto_profil_anak', $nama_foto);

                $alert = [
                    'success' => 'Data murid Berhasil diSimpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $murid = $this->muridModel->where(["id" => $id])->first();
            $status_murid = $this->statusMuridModel->getStatusMurid();
            $program_belajar = $this->programBelajarModel->getProgramBelajar();
            $materi_belajar = $this->materiBelajarModel->getMateriBelajar();
            $paket_belajar = $this->paketBelajarModel->getPaketBelajar();

            $data = [
                'murid' => $murid,
                'status_murid' => $status_murid,
                'program_belajar' => $program_belajar,
                'paket_belajar' => $paket_belajar,
                'materi_belajar' => $materi_belajar
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $murid = $this->muridModel->where(["id" => $id])->first();

            $path_foto = 'foto_profil_anak/' . $murid['foto_anak'];

            $this->muridModel->delete($murid["id"]);

            $alert = [
                'success' => 'Murid Berhasil di Hapus !'
            ];

            if ($murid['foto_anak'] != null) {
                if (file_exists($path_foto)) {
                    unlink($path_foto);
                }
            }

            return json_encode($alert);
        }
    }

    public function view($id)
    {
        if ($id == null) {
            return redirect()->to('/admin/data_murid');
        }

        $profil = $this->muridModel->getMitramurid($id);


        if ($profil == null) {
            return redirect()->to('/admin/data_murid');
        }

        $data = [
            'title' => 'Peserta Didik',
            'profil' => $profil,
        ];

        return view('admin/profil_murid_v', $data);
    }

    public function update()
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

                'nama_ayah' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Ayah Tidak Boleh Kosong !'
                    ]
                ],
                'pekerjaan_ayah' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pekerjaan Ayah Tidak Boleh Kosong !'
                    ]
                ],
                'nama_ibu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Ibu Tidak Boleh Kosong !'
                    ]
                ],
                'pekerjaan_ibu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pekerjaan Ibu Tidak Boleh Kosong !'
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
                'info_les' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Informasi Les Tidak Boleh Kosong !'
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
                        'required' => 'Program Belajar  Tidak Boleh Kosong !'
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

                'status_murid_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Murid Tidak Boleh Kosong !'
                    ]
                ],
                'brosur' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Info Harga Tidak Boleh Kosong !'
                    ]
                ],
                'data' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Persetujuan Tidak Boleh Kosong !'
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
                        'nama_ayah' => $this->validation->getError('nama_ayah'),
                        'pekerjaan_ayah' => $this->validation->getError('pekerjaan_ayah'),
                        'nama_ibu' => $this->validation->getError('nama_ibu'),
                        'pekerjaan_ibu' => $this->validation->getError('pekerjaan_ibu'),
                        'nomor_whatsapp_wali' => $this->validation->getError('nomor_whatsapp_wali'),
                        'username_instagram_wali' => $this->validation->getError('username_instagram_wali'),
                        'info_les' => $this->validation->getError('info_les'),
                        'paket_belajar_id' => $this->validation->getError('paket_belajar_id'),
                        'program_belajar_id' => $this->validation->getError('program_belajar_id'),
                        'materi_belajar_id' => $this->validation->getError('materi_belajar_id'),
                        'hari_belajar' => $this->validation->getError('hari_belajar'),
                        'waktu_belajar' => $this->validation->getError('waktu_belajar'),

                        'status_murid_id' => $this->validation->getError('status_murid_id'),
                        'brosur' => $this->validation->getError('brosur'),
                        'data' => $this->validation->getError('data'),
                    ]
                ];
            } else {

                $id = $this->request->getVar('id');
                $foto_lama = $this->request->getVar('foto_lama');

                $regMurid = $this->muridModel->where(["id" => $id])->first();
                $uid_murid = $this->muridModel->countAllResults();

                $nama_lengkap_anak = $this->request->getPost('nama_lengkap_anak');
                $tanggal_lahir_anak = $this->request->getPost('tanggal_lahir_anak');
                $usia_anak = $this->request->getPost('usia_anak');
                $alamat_domisili_anak = $this->request->getPost('alamat_domisili_anak');
                $sekolah_anak = $this->request->getPost('sekolah_anak');
                $nama_ayah = $this->request->getPost('nama_ayah');
                $pekerjaan_ayah = $this->request->getPost('pekerjaan_ayah');
                $nama_ibu = $this->request->getPost('nama_ibu');
                $pekerjaan_ibu = $this->request->getPost('pekerjaan_ibu');
                $nomor_whatsapp_wali = $this->request->getPost('nomor_whatsapp_wali');
                $username_instagram_wali = $this->request->getPost('username_instagram_wali');
                $info_les = $this->request->getPost('info_les');
                $paket_belajar_id = $this->request->getPost('paket_belajar_id');
                $program_belajar_id = $this->request->getPost('program_belajar_id');
                $materi_belajar_id = $this->request->getPost('materi_belajar_id');
                $hari_belajar = $this->request->getPost('hari_belajar');
                $waktu_belajar = $this->request->getPost('waktu_belajar');

                $foto_anak = $this->request->getFile('foto_anak');
                $brosur = $this->request->getPost('brosur');
                $data = $this->request->getPost('data');

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

                $status_murid_id = $this->request->getPost('status_murid_id');

                $this->muridModel->update($id, [
                    'uid_murid' => $uid_murid,
                    'nama_lengkap_anak' => strtolower($nama_lengkap_anak),
                    'tanggal_lahir_anak' => strtolower($tanggal_lahir_anak),
                    'usia_anak' => strtolower($usia_anak),
                    'alamat_domisili_anak' => strtolower($alamat_domisili_anak),
                    'sekolah_anak' => strtolower($sekolah_anak),
                    'nama_ayah' => strtolower($nama_ayah),
                    'pekerjaan_ayah' => strtolower($pekerjaan_ayah),
                    'nama_ibu' => strtolower($nama_ibu),
                    'pekerjaan_ibu' => strtolower($pekerjaan_ibu),
                    'nomor_whatsapp_wali' => strtolower($nomor_whatsapp_wali),
                    'username_instagram_wali' => strtolower($username_instagram_wali),
                    'info_les' => strtolower($info_les),
                    'paket_belajar_id' => strtolower($paket_belajar_id),
                    'program_belajar_id' => strtolower($program_belajar_id),
                    'materi_belajar_id' => strtolower($materi_belajar_id),
                    'hari_belajar' => strtolower($hari_belajar),
                    'waktu_belajar' => strtolower($waktu_belajar),
                    'foto_anak' => strtolower($nama_foto),
                    'status_murid_id' => strtolower($status_murid_id),
                    'brosur' => strtolower($brosur),
                    'data' => strtolower($data),
                ]);

                $alert = [
                    'success' => 'Data murid Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function ulang_tahun()
    {
        helper(['format']);
        $tahun = date('Y');
        $bulan = date('m');


        $data_murid_ultah = $this->muridModel->getDataUltahMurid();
        $data_ultah_bulan_ini = $this->muridModel->getDataPesertaWithBulanUltah($bulan);

        $data = [
            'title' => 'Ulang Tahun Peserta Didik',
            'status_murid' => $this->statusMuridModel->getStatusMurid(),
            'data_murid_ultah' => $data_murid_ultah,
            'data_ultah_bulan_ini' => $data_ultah_bulan_ini,
            'tahun' => $tahun
        ];

        return view('admin/ultah_peserta_v', $data);
    }

    public function data_ulang_tahun_murid()
    {
        if ($this->request->isAJAX()) {

            $bulan = $this->request->getVar('bulan');

            $data_ultah = $this->muridModel->getDataPesertaWithBulanUltah($bulan);

            $data = [
                'data_ultah' => $data_ultah,
                'tahun' => date('Y')
            ];

            return json_encode($data);
        }
    }
}
