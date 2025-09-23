<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Admin\StatusMuridModel;
use App\Models\Ahl\PesertaDidikAhlModel;
use App\Models\Ahl\ProgramAHLModel;
use App\Models\Ahl\TingkatPendidikanModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class PesertaDidikAhlController extends BaseController
{
    protected $pesertaDidikAhlModel;
    protected $programAhlModel;
    protected $tingkatPendidikanModel;
    protected $statusMuridModel;
    protected $validation;

    public function __construct()
    {
        $this->pesertaDidikAhlModel = new PesertaDidikAhlModel();
        $this->programAhlModel = new ProgramAHLModel();
        $this->tingkatPendidikanModel = new TingkatPendidikanModel();
        $this->statusMuridModel = new StatusMuridModel();
        $this->validation = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'title' => 'Peserta Didik AHL',
            'program_ahl' => $this->programAhlModel->getProgramAHL(),
            'pendidikan' => $this->tingkatPendidikanModel->getPendidikan(),
            'status_murid' => $this->statusMuridModel->getStatusMurid()
        ];

        return view('ahl/peserta_ahl_v', $data);
    }


    public function getPesertaAhl()
    {
        if ($this->request->isAjax()) {
            $peserta_didik_ahl = $this->pesertaDidikAhlModel->getPesertaAhl();

            return DataTable::of($peserta_didik_ahl)
                ->add('action', function ($row) {
                    return '<button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' .  $row->id . '" type="button">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    
                    <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>';
                })
                ->add('lihat_profil', function ($row) {
                    return '<a href="/admin/peserta_ahl/getProfil/' .  $row->id . '"" class="btn btn-sm btn-outline-primary" target="_blank" >
                                                    <i class="bi bi-eye"></i> Lihat Profil
                                                </a>
                           ';
                })
                ->setSearchableColumns(['nama_lengkap_anak', 'id', 'status_murid'])
                ->addNumbering('no')->toJson(true);
        }
    }


    public function getProfil($id)
    {
        if ($id == null) {
            dd($id);
            return redirect()->to('/admin/data_murid');
        }

        $profil = $this->pesertaDidikAhlModel->getProfil($id);
        // dd($profil);
        $hari_ini = date_create();
        $tanggal_lahir = date_create($profil->tanggal_lahir_anak);

        $usia = date_diff($hari_ini, $tanggal_lahir);

        if ($profil == null) {
            return redirect()->to('/admin/data_murid');
        }

        $data = [
            'title' => 'Profil Peserta Didik AHL',
            'profil' => $profil,
            'usia' => $usia
        ];

        return view('ahl/profil_ahl_v', $data);
    }


    public function insert()
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

                        'izin_dokumentasi' => $this->validation->getError('izin_dokumentasi'),
                        'info_alifya' => $this->validation->getError('info_alifya'),
                        'data_1' => $this->validation->getError('data_1'),
                        'data_2' => $this->validation->getError('data_2'),


                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $foto_anak_lama = $this->request->getVar('foto_anak_lama');
                $bukti_tf_lama = $this->request->getVar('bukti_tf_lama');

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
                $tangal_bergabung = $this->request->getVar('tanggal_bergabung');

                $status_peserta_id = 3;

                $path_foto_lama = 'foto_profil_anak_ahl/' . $foto_anak_lama;
                $path_bukti_tf_lama = 'bukti_tf_lama/' . $bukti_tf_lama;

                if ($foto_anak->getError() == 4) {
                    $nama_foto = $foto_anak_lama;
                } else {
                    if (file_exists($path_foto_lama)) {
                        unlink($path_foto_lama);
                    }
                    $nama_foto = $foto_anak->getRandomName();
                    $foto_anak->move('foto_profil_anak_ahl', $nama_foto);
                }

                if ($bukti_tf->getError() == 4) {
                    $nama_foto = $bukti_tf_lama;
                } else {
                    if (file_exists($path_bukti_tf_lama)) {
                        unlink($path_bukti_tf_lama);
                    }
                    $nama_foto_tf = $bukti_tf->getRandomName();
                    $bukti_tf->move('foto_profil_anak_ahl', $nama_foto_tf);
                }

                $this->pesertaDidikAhlModel->update($id, [
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
                    'tanggal_bergabung' => $tangal_bergabung
                ]);

                $alert = [
                    'success' => 'Peserta Didik Berhasil di Ubah!'
                ];
            }

            return json_encode($alert);
        }
    }


    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $data = [
                'peserta_ahl' => $this->pesertaDidikAhlModel->where(["id" => $id])->first(),
                'program_ahl' => $this->programAhlModel->getProgramAHL(),
                'pendidikan' => $this->tingkatPendidikanModel->getPendidikan()
            ];


            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {


            $id = $this->request->getVar('id');

            $peserta_didik_ahl = $this->pesertaDidikAhlModel->where(["id" => $id])->first();

            $path_foto = 'foto_profil_anak_ahl/' . $peserta_didik_ahl['foto_anak'];
            $path_bukti_tf = 'bukti_tf/' . $peserta_didik_ahl['bukti_tf'];

            $this->pesertaDidikAhlModel->delete($peserta_didik_ahl["id"]);

            $alert = [
                'success' => 'Peserta AHL Berhasil di Hapus!'
            ];

            if ($peserta_didik_ahl['foto_anak'] != null) {
                if (file_exists($path_foto)) {
                    unlink($path_foto);
                }
            }

            if ($peserta_didik_ahl['bukti_tf'] != null) {
                if (file_exists($path_bukti_tf)) {
                    unlink($path_bukti_tf);
                }
            }

            return json_encode($alert);
        }
    }

    public function update()
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

                        'izin_dokumentasi' => $this->validation->getError('izin_dokumentasi'),
                        'info_alifya' => $this->validation->getError('info_alifya'),
                        'data_1' => $this->validation->getError('data_1'),
                        'data_2' => $this->validation->getError('data_2'),


                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $foto_anak_lama = $this->request->getVar('foto_anak_lama');
                $bukti_tf_lama = $this->request->getVar('bukti_tf_lama');

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
                $bukti_tf = $this->request->getFile('bukti_tf');

                $izin_dokumentasi = $this->request->getPost('izin_dokumentasi');
                $info_alifya = $this->request->getPost('info_alifya');
                $data_1 = $this->request->getPost('data_1');
                $data_2 = $this->request->getPost('data_2');
                $tangal_bergabung = $this->request->getVar('tanggal_bergabung');

                $status_peserta_id = $this->request->getVar('status_peserta_id');

                if ($foto_anak->getError() == 4) {
                    $nama_foto = $foto_anak_lama;
                } else {
                    if ($foto_anak_lama != null) {
                        unlink('foto_profil_anak_ahl/' . $foto_anak_lama);
                    }
                    $nama_foto = $foto_anak->getRandomName();
                    $foto_anak->move('foto_profil_anak_ahl', $nama_foto);
                }

                if ($bukti_tf->getError() == 4) {
                    $nama_foto_tf = $bukti_tf_lama;
                } else {
                    if ($bukti_tf_lama != null) {
                        unlink('bukti_tf/' . $bukti_tf_lama);
                    }
                    $nama_foto_tf = $bukti_tf->getRandomName();
                    $bukti_tf->move('bukti_tf', $nama_foto_tf);
                }

                $this->pesertaDidikAhlModel->update($id, [
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
                    'tanggal_bergabung' => $tangal_bergabung
                ]);

                $alert = [
                    'success' => 'Peserta Didik Berhasil di Ubah!'
                ];
            }

            return json_encode($alert);
        }
    }
}
