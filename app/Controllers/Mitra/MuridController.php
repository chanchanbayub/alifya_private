<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Admin\PaketBelajarModel;
use App\Models\Admin\ProgramBelajarModel;
use App\Models\Admin\StatusMuridModel;
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

    protected $validation;

    public function __construct()
    {
        $this->muridModel = new MuridModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->statusMuridModel = new StatusMuridModel();
        $this->programBelajarModel = new ProgramBelajarModel();
        $this->materiBelajarModel = new MateriBelajarModel();
        $this->paketBelajarModel = new PaketBelajarModel();

        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        // dd('helo');
        $data_murid = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar(session()->get('mitra_pengajar_id'));

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
            return redirect()->to('/mitra_pengajar/data_murid');
        }

        $profil = $this->muridModel->getMitraMurid($id);

        if ($profil == null) {
            return redirect()->to('/mitra_pengajar/data_murid');
        }

        $data = [
            'title' => 'Peserta Didik',
            'profil' => $profil,
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

            $data = [
                'murid' => $murid,
                'program_belajar' => $program_belajar,
                'paket_belajar' => $paket_belajar,
                'materi_belajar' => $materi_belajar
            ];

            return json_encode($data);
        }
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
}
