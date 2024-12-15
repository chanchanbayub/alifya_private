<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\StatusPengajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class PengajarController extends BaseController
{
    protected $pengajarModel;
    protected $statusPengajarModel;
    protected $validation;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->statusPengajarModel = new StatusPengajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Mitra Pengajar',
            'status_pengajar' => $this->statusPengajarModel->getStatusPengajar(),
            'data_pengajar' => $this->pengajarModel->getDataPengajar()
        ];

        return view('admin/pengajar_v', $data);
    }

    public function ulang_tahun()
    {
        helper(['format']);
        $tahun = date('Y');


        $data = [
            'title' => 'Ulang Tahun Mitra Pengajar',
            'status_pengajar' => $this->statusPengajarModel->getStatusPengajar(),
            'data_pengajar_ultah' => $this->pengajarModel->getDataPengajarUltah(),
            'tahun' => $tahun
        ];

        return view('admin/ultah_pengajar_v', $data);
    }

    public function data_ulang_tahun_mitra()
    {
        if ($this->request->isAJAX()) {

            $bulan = $this->request->getVar('bulan');

            $data_ultah = $this->pengajarModel->getDataPengajarWithBulanUltah($bulan);

            $data = [
                'data_ultah' => $data_ultah,
                'tahun' => date('Y')
            ];

            return json_encode($data);
        }
    }

    public function insert()
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

                'pernyataan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],

                'kontrak' => [
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
                    'rules' => 'uploaded[foto]|max_size[foto,5048]|is_image[foto]|mime_in[foto,image/png,image/jpeg,image.jpg]',
                    'errors' => [
                        'uploaded' => 'Foto Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],
                'ijazah' => [
                    'rules' => 'uploaded[ijazah]|max_size[ijazah,5048]|mime_in[ijazah,application/pdf]',
                    'errors' => [
                        'uploaded' => 'ijazah Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                    ]
                ],
                'cv' => [
                    'rules' => 'uploaded[cv]|max_size[cv,5048]|mime_in[cv,application/pdf]',
                    'errors' => [
                        'uploaded' => 'CV Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                    ]
                ],

                'status_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'nama_lengkap' => $this->validation->getError('nama_lengkap'),
                        'email' => $this->validation->getError('email'),
                        'tanggal_lahir_mitra' => $this->validation->getError('tanggal_lahir_mitra'),
                        'usia' => $this->validation->getError('usia'),
                        'alamat_domisili' => $this->validation->getError('alamat_domisili'),
                        'pendidikan_terakhir' => $this->validation->getError('pendidikan_terakhir'),
                        'jurusan' => $this->validation->getError('jurusan'),
                        'status_perkawinan' => $this->validation->getError('status_perkawinan'),
                        'nomor_whatsapp' => $this->validation->getError('nomor_whatsapp'),
                        'username_instagram' => $this->validation->getError('username_instagram'),
                        'pekerjaan' => $this->validation->getError('pekerjaan'),
                        'pernyataan' => $this->validation->getError('pernyataan'),
                        'kontrak' => $this->validation->getError('kontrak'),
                        'kendaraan_pribadi' => $this->validation->getError('kendaraan_pribadi'),
                        'media_belajar' => $this->validation->getError('media_belajar'),
                        'alasan_bergabung' => $this->validation->getError('alasan_bergabung'),
                        'kelebihan' => $this->validation->getError('kelebihan'),
                        'info_loker' => $this->validation->getError('info_loker'),
                        'ijazah' => $this->validation->getError('ijazah'),
                        'foto' => $this->validation->getError('foto'),
                        'cv' => $this->validation->getError('cv'),
                        'status_id' => $this->validation->getError('status_id'),
                    ]
                ];
            } else {

                $regIdMitra = $this->pengajarModel->countAllResults();

                $uid = $regIdMitra + 1;
                $nama_lengkap = $this->request->getPost('nama_lengkap');
                $email = $this->request->getPost('email');
                $tanggal_lahir_mitra = $this->request->getPost('tanggal_lahir_mitra');
                $usia = $this->request->getPost('usia');
                $alamat_domisili = $this->request->getPost('alamat_domisili');
                $pendidikan_terakhir = $this->request->getPost('pendidikan_terakhir');
                $jurusan = $this->request->getPost('jurusan');
                $status_perkawinan = $this->request->getPost('status_perkawinan');
                $nomor_whatsapp = $this->request->getPost('nomor_whatsapp');
                $username_instagram = $this->request->getPost('username_instagram');
                $pekerjaan = $this->request->getPost('pekerjaan');
                $pernyataan = $this->request->getPost('pernyataan');
                $info_loker = $this->request->getPost('info_loker');
                $kontrak = $this->request->getPost('kontrak');
                $kendaraan_pribadi = $this->request->getPost('kendaraan_pribadi');
                $media_belajar = $this->request->getPost('media_belajar');
                $alasan_bergabung = $this->request->getPost('alasan_bergabung');
                $kelebihan = $this->request->getPost('kelebihan');


                $ijazah = $this->request->getFile('ijazah');
                $foto = $this->request->getFile('foto');
                $cv = $this->request->getFile('cv');

                $nama_ijazah = $ijazah->getRandomName();
                $nama_foto = $foto->getRandomName();
                $nama_cv = $cv->getRandomName();

                $status_id = $this->request->getPost('status_id');

                $ijazah->move('ijazah', $nama_ijazah);
                $foto->move('foto_profil', $nama_foto);
                $cv->move('cv_file', $nama_cv);


                $this->pengajarModel->save([
                    'uid' => $uid,
                    'nama_lengkap' => strtolower($nama_lengkap),
                    'email' => strtolower($email),
                    'tanggal_lahir_mitra' => $tanggal_lahir_mitra,
                    'usia' => strtolower($usia),
                    'alamat_domisili' => strtolower($alamat_domisili),
                    'pendidikan_terakhir' => strtolower($pendidikan_terakhir),
                    'jurusan' => strtolower($jurusan),
                    'status_perkawinan' => strtolower($status_perkawinan),
                    'nomor_whatsapp' => strtolower($nomor_whatsapp),
                    'username_instagram' => strtolower($username_instagram),

                    'pekerjaan' => strtolower($pekerjaan),
                    'pernyataan' => strtolower($pernyataan),
                    'kontrak' => strtolower($kontrak),
                    'kendaraan_pribadi' => strtolower($kendaraan_pribadi),
                    'media_belajar' => strtolower($media_belajar),
                    'alasan_bergabung' => strtolower($alasan_bergabung),
                    'kelebihan' => strtolower($kelebihan),
                    'info_loker' => strtolower($info_loker),

                    'ijazah' => $nama_ijazah,
                    'foto' => $nama_foto,
                    'cv' => $nama_cv,


                    'status_id' => strtolower($status_id),

                ]);

                $alert = [
                    'success' => 'Data Pengajar Berhasil diSimpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $status_pengajar = $this->statusPengajarModel->getStatusPengajar();

            $pengajar = $this->pengajarModel->where(["id" => $id])->first();

            $data = [
                'pengajar' => $pengajar,
                'status_pengajar' => $status_pengajar
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $pengajar = $this->pengajarModel->where(["id" => $id])->first();

            $path_foto = 'foto_profil/' . $pengajar['foto'];
            $path_cv = 'cv_file/' . $pengajar['cv'];
            $path_ijazah = 'ijazah/' . $pengajar['ijazah'];

            $this->pengajarModel->delete($pengajar["id"]);

            $alert = [
                'success' => 'Pengajar Berhasil di Hapus !'
            ];

            if ($pengajar['foto'] != null || $pengajar['cv'] != null || $pengajar['ijazah'] != null) {
                if (file_exists($path_foto) || file_exists($path_cv) || file_exists($path_ijazah)) {
                    unlink($path_foto);
                    unlink($path_cv);
                    unlink($path_ijazah);
                }
            }

            return json_encode($alert);
        }
    }

    public function update()
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

                'pernyataan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],

                'kontrak' => [
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

                'status_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'nama_lengkap' => $this->validation->getError('nama_lengkap'),
                        'email' => $this->validation->getError('email'),
                        'tanggal_lahir_mitra' => $this->validation->getError('tanggal_lahir_mitra'),
                        'usia' => $this->validation->getError('usia'),
                        'alamat_domisili' => $this->validation->getError('alamat_domisili'),
                        'pendidikan_terakhir' => $this->validation->getError('pendidikan_terakhir'),
                        'jurusan' => $this->validation->getError('jurusan'),
                        'status_perkawinan' => $this->validation->getError('status_perkawinan'),
                        'nomor_whatsapp' => $this->validation->getError('nomor_whatsapp'),
                        'username_instagram' => $this->validation->getError('username_instagram'),
                        'pekerjaan' => $this->validation->getError('pekerjaan'),
                        'pernyataan' => $this->validation->getError('pernyataan'),
                        'kontrak' => $this->validation->getError('kontrak'),
                        'kendaraan_pribadi' => $this->validation->getError('kendaraan_pribadi'),
                        'media_belajar' => $this->validation->getError('media_belajar'),
                        'alasan_bergabung' => $this->validation->getError('alasan_bergabung'),
                        'kelebihan' => $this->validation->getError('kelebihan'),
                        'info_loker' => $this->validation->getError('info_loker'),
                        'status_id' => $this->validation->getError('status_id'),
                    ]
                ];
            } else {

                $id = $this->request->getVar('id');
                $fotoLama = $this->request->getVar('fotoLama');
                $ijazahLama = $this->request->getVar('ijazahLama');
                $cvLama = $this->request->getVar('cvLama');

                $regIdMitra = $this->pengajarModel->where(["id" => $id])->first();

                $uid = $this->pengajarModel->countAllResults();
                $nama_lengkap = $this->request->getPost('nama_lengkap');
                $email = $this->request->getPost('email');
                $tanggal_lahir_mitra = $this->request->getPost('tanggal_lahir_mitra');
                $usia = $this->request->getPost('usia');
                $alamat_domisili = $this->request->getPost('alamat_domisili');
                $pendidikan_terakhir = $this->request->getPost('pendidikan_terakhir');
                $jurusan = $this->request->getPost('jurusan');
                $status_perkawinan = $this->request->getPost('status_perkawinan');
                $nomor_whatsapp = $this->request->getPost('nomor_whatsapp');
                $username_instagram = $this->request->getPost('username_instagram');

                $pekerjaan = $this->request->getPost('pekerjaan');
                $pernyataan = $this->request->getPost('pernyataan');
                $info_loker = $this->request->getPost('info_loker');
                $kontrak = $this->request->getPost('kontrak');
                $kendaraan_pribadi = $this->request->getPost('kendaraan_pribadi');
                $media_belajar = $this->request->getPost('media_belajar');
                $alasan_bergabung = $this->request->getPost('alasan_bergabung');
                $kelebihan = $this->request->getPost('kelebihan');


                $ijazah = $this->request->getFile('ijazah');

                $foto = $this->request->getFile('foto');
                $cv = $this->request->getFile('cv');

                $path_ijazah_lama = 'ijazah/' . $ijazahLama;
                $path_foto_lama = 'foto_profil/' . $fotoLama;
                $path_cv_lama = 'cv_file/' . $cvLama;

                if ($ijazah->getError() == 4) {
                    $nama_ijazah = $ijazahLama;
                } else {
                    if (file_exists($path_ijazah_lama)) {
                        unlink($path_ijazah_lama);
                    }
                    $nama_ijazah = $ijazah->getRandomName();
                    $ijazah->move('ijazah', $nama_ijazah);
                }

                if ($foto->getError() == 4) {
                    $nama_foto = $fotoLama;
                } else {
                    if (file_exists($path_foto_lama)) {
                        unlink($path_foto_lama);
                    }
                    $nama_foto = $foto->getRandomName();
                    $foto->move('foto_profil', $nama_foto);
                }

                if ($cv->getError() == 4) {
                    $nama_cv = $cvLama;
                } else {
                    if (file_exists($path_cv_lama)) {
                        unlink($path_cv_lama);
                    }
                    $nama_cv = $cv->getRandomName();
                    $cv->move('cv_file', $nama_cv);
                }

                $status_id = $this->request->getPost('status_id');

                $this->pengajarModel->update($id, [
                    'uid' => $uid,
                    'nama_lengkap' => strtolower($nama_lengkap),
                    'email' => strtolower($email),
                    'tanggal_lahir_mitra' => $tanggal_lahir_mitra,
                    'usia' => strtolower($usia),
                    'alamat_domisili' => strtolower($alamat_domisili),
                    'pendidikan_terakhir' => strtolower($pendidikan_terakhir),
                    'jurusan' => strtolower($jurusan),
                    'status_perkawinan' => strtolower($status_perkawinan),
                    'nomor_whatsapp' => strtolower($nomor_whatsapp),
                    'username_instagram' => strtolower($username_instagram),

                    'pekerjaan' => strtolower($pekerjaan),
                    'pernyataan' => strtolower($pernyataan),
                    'kontrak' => strtolower($kontrak),
                    'kendaraan_pribadi' => strtolower($kendaraan_pribadi),
                    'media_belajar' => strtolower($media_belajar),
                    'alasan_bergabung' => strtolower($alasan_bergabung),
                    'kelebihan' => strtolower($kelebihan),
                    'info_loker' => strtolower($info_loker),

                    'ijazah' => $nama_ijazah,

                    'foto' => $nama_foto,
                    'cv' => $nama_cv,
                    'status_id' => strtolower($status_id),

                ]);

                $alert = [
                    'success' => 'Data Pengajar Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function view($email)
    {
        if ($email == null) {
            return redirect()->to('/admin/data_pengajar');
        }

        $mitra_pengajar = $this->pengajarModel->getMitraPengajar($email);
        // dd($mitra_pengajar);

        if ($mitra_pengajar == null) {
            return redirect()->to('/admin/data_pengajar');
        }

        $data = [
            'title' => 'Detail Mitra Pengajar',
            'mitra_pengajar' => $mitra_pengajar,
        ];

        return view('admin/users_profil_v', $data);
    }
}
