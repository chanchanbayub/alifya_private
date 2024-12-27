<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Admin\JenisMediaBelajarModel;
use App\Models\Admin\MuridModel;
use App\Models\Mitra\KelompokBelajarModel;
use App\Models\Mitra\KlaimMediaPesertaModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class KlaimMediaPesertaController extends BaseController
{
    protected $muridModel;
    protected $jenisMediaBelajarModel;
    protected $klaimMediaBelajarModel;
    protected $kelompokBelajarModel;
    protected $validation;

    public function __construct()
    {
        $this->muridModel = new MuridModel();
        $this->jenisMediaBelajarModel = new JenisMediaBelajarModel();
        $this->validation = \Config\Services::validation();
        $this->klaimMediaBelajarModel = new KlaimMediaPesertaModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
    }

    public function index()
    {

        $jenis_media = $this->jenisMediaBelajarModel->getJenisMediaBelajar();
        $peserta_didik = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar(session()->get('mitra_pengajar_id'));
        $klaim_media = $this->klaimMediaBelajarModel->getHargaMediaWhereMitra(session()->get('mitra_pengajar_id'));
        // dd($klaim_media);

        $data = [
            'title' => 'Klaim Media Belajar',
            'peserta_didik' => $peserta_didik,
            'jenis_media' => $jenis_media
        ];

        return view('mitra/klaim_media_v', $data);
    }

    public function getDataHargaMedia()
    {
        if ($this->request->isAjax()) {

            $klaim_media = $this->klaimMediaBelajarModel->getHargaMediaWhereMitra(session()->get('mitra_pengajar_id'));

            return DataTable::of($klaim_media)
                ->add('faktur', function ($row) {
                    if ($row->faktur == null) {
                        return '<button href ="#" class="btn btn-sm btn-link" disabled>
                        </i> Lihat Faktur </button>';
                    } else {
                        return '<a href ="/faktur/' . $row->faktur . '" target="_blank" class="btn btn-sm btn-link">
                        </i> Lihat Faktur </a>';
                    }
                })
                ->setSearchableColumns(['nama_lengkap_anak', 'bulan', 'harga_media', 'nama_media', 'tahun'])
                ->addNumbering('no')->toJson(true);
        }
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

                'jenis_media_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Media Tidak Boleh Kosong !'
                    ]
                ],

                'harga_media' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harga Media Tidak Boleh Kosong !'
                    ]
                ],

                'lain_lain' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lain-Lain Tidak Boleh Kosong !'
                    ]
                ],

                'faktur' => [
                    'rules' => 'max_size[faktur,2048]|is_image[faktur]|mime_in[faktur,image/png,image/jpeg]',
                    'errors' => [
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'bulan' => $this->validation->getError('bulan'),
                        'jenis_media_id' => $this->validation->getError('jenis_media_id'),
                        'harga_media' => $this->validation->getError('harga_media'),
                        'lain_lain' => $this->validation->getError('lain_lain'),
                        'faktur' => $this->validation->getError('faktur'),

                    ]
                ];
            } else {

                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $bulan = $this->request->getPost('bulan');
                $tahun = date('Y');
                $jenis_media_id = $this->request->getPost('jenis_media_id');
                $harga_media = $this->request->getPost('harga_media');
                $lain_lain = $this->request->getPost('lain_lain');
                $faktur = $this->request->getFile('faktur');


                if ($faktur->getError() == 4) {
                    $namaFaktur = null;
                } else {
                    $namaFaktur = $faktur->getRandomName();
                    $faktur->move('faktur', $namaFaktur);
                }

                $this->klaimMediaBelajarModel->save([
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'bulan' => strtolower($bulan),
                    'tahun' => strtolower($tahun),
                    'jenis_media_id' => $jenis_media_id,
                    'harga_media' => $harga_media,
                    'lain_lain' => $lain_lain,
                    'faktur' => $namaFaktur,
                ]);


                $alert = [
                    'success' => 'Harga Media Belajar Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $klaim_media = $this->klaimMediaBelajarModel->where(["id" => $id])->first();
            $peserta_didik = $this->muridModel->getDataMuridAktif();
            $jenis_media = $this->jenisMediaBelajarModel->getJenisMediaBelajar();

            $data = [
                'klaim_media' => $klaim_media,
                'peserta_didik' => $peserta_didik,
                'jenis_media' => $jenis_media
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $klaim_media = $this->klaimMediaBelajarModel->where(["id" => $id])->first();

            $path_foto = 'faktur/' . $klaim_media['faktur'];

            if ($klaim_media["faktur"] != null) {
                if (file_exists($path_foto)) {
                    unlink($path_foto);
                }
            }

            $this->klaimMediaBelajarModel->delete($klaim_media["id"]);

            $alert = [
                'success' => 'Klaim Media Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],
                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

                'jenis_media_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Media Tidak Boleh Kosong !'
                    ]
                ],

                'harga_media' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harga Media Tidak Boleh Kosong !'
                    ]
                ],

                'lain_lain' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lain-Lain Tidak Boleh Kosong !'
                    ]
                ],

                'faktur' => [
                    'rules' => 'max_size[faktur,2048]|is_image[faktur]|mime_in[faktur,image/png,image/jpeg]',
                    'errors' => [
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'bulan' => $this->validation->getError('bulan'),
                        'jenis_media_id' => $this->validation->getError('jenis_media_id'),
                        'harga_media' => $this->validation->getError('harga_media'),
                        'lain_lain' => $this->validation->getError('lain_lain'),
                        'faktur' => $this->validation->getError('faktur'),

                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $faktur_lama = $this->request->getPost('faktur_lama');
                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $bulan = $this->request->getPost('bulan');
                $tahun = date('Y');
                $jenis_media_id = $this->request->getPost('jenis_media_id');
                $harga_media = $this->request->getPost('harga_media');
                $lain_lain = $this->request->getPost('lain_lain');
                $faktur = $this->request->getFile('faktur');

                if ($faktur->getError() == 4) {
                    $namaFaktur = $faktur_lama;
                } else {
                    $namaFaktur = $faktur->getRandomName();
                    $faktur->move('faktur', $namaFaktur);
                }

                $this->klaimMediaBelajarModel->update($id, [
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'bulan' => strtolower($bulan),
                    'tahun' => strtolower($tahun),
                    'jenis_media_id' => $jenis_media_id,
                    'harga_media' => $harga_media,
                    'lain_lain' => $lain_lain,
                    'faktur' => $namaFaktur,
                ]);


                $alert = [
                    'success' => 'Harga Media Belajar Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
