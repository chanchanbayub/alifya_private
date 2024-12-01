<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Admin\JenisMediaBelajarModel;
use App\Models\Mitra\HargaModel;
use App\Models\Mitra\KelompokBelajarModel;
use App\Models\Mitra\KelompokModel;
use App\Models\Mitra\MuridModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Session;

class HargaController extends BaseController
{
    protected $hargaModel;
    protected $muridModel;
    protected $kelompokModel;
    protected $jenisMediaBelajarModel;
    protected $kelompokBelajarModel;
    protected $validation;

    public function __construct()
    {
        $this->hargaModel = new HargaModel();
        $this->muridModel = new MuridModel();
        $this->kelompokModel = new KelompokModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->jenisMediaBelajarModel = new JenisMediaBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $harga_perjam = $this->hargaModel->getHargaWherePesertaDidik(session()->get('mitra_pengajar_id'));
        $jenis_media = $this->jenisMediaBelajarModel->getJenisMediaBelajar();
        $peserta_didik = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar(session()->get('mitra_pengajar_id'));

        $data = [
            'title' => 'Harga Media Belajar',
            'harga_perjam' => $harga_perjam,
            'peserta_didik' => $peserta_didik,
            'jenis_media' => $jenis_media,
            'peserta_didik' => $peserta_didik,
        ];

        return view('mitra/harga_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Peserta Didik Tidak Boleh Kosong !'
                    ]
                ],

                'jenis_media_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Media Tidak Boleh Kosong !'
                    ]
                ],

                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Tidak Boleh Kosong !'
                    ]
                ],
                'faktur' => [
                    'rules' => 'uploaded[faktur]|max_size[faktur,1028]|is_image[faktur]|mime_in[faktur,image/png,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'Foto Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 1MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],
                'media_belajar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Media Belajar Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'jenis_media_id' => $this->validation->getError('jenis_media_id'),
                        'bulan' => $this->validation->getError('bulan'),
                        'faktur' => $this->validation->getError('faktur'),
                        'media_belajar' => $this->validation->getError('media_belajar'),

                    ]
                ];
            } else {

                $peserta_didik_id = $this->request->getPost('peserta_didik_id');

                $harga = $this->hargaModel->getHargaPerbulan($peserta_didik_id);

                $bulan = $this->request->getPost('bulan');

                $jenis_media_id = $this->request->getPost('jenis_media_id');

                $media_belajar = $this->request->getPost('media_belajar');

                $faktur = $this->request->getFile('faktur');

                $nama_foto = $faktur->getRandomName();

                $this->hargaModel->save([
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'bulan' => strtolower($bulan),
                    'jenis_media_id' => strtolower($jenis_media_id),
                    'faktur' => $nama_foto,
                    'harga' => $harga->harga,
                    'media_belajar' => strtolower($media_belajar),

                ]);

                $faktur->move('faktur', $nama_foto);

                $alert = [
                    'success' => 'Upah Anak Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $harga = $this->hargaModel->where(["id" => $id])->first();
            $peserta_didik = $this->muridModel->getDataMuridAktif();

            $data = [
                'harga' => $harga,
                'peserta_didik' => $peserta_didik
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $harga = $this->hargaModel->where(["id" => $id])->first();

            $this->hargaModel->delete($harga["id"]);

            $alert = [
                'success' => 'Upah Berhasil di Hapus !'
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
                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],
                'media_belajar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Media Belajar Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'harga' => $this->validation->getError('harga'),
                        'media_belajar' => $this->validation->getError('media_belajar'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $harga = $this->request->getPost('harga');
                $media_belajar = $this->request->getPost('media_belajar');

                $this->hargaModel->update($id, [
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'harga' => strtolower($harga),
                    'media_belajar' => strtolower($media_belajar),

                ]);

                $alert = [
                    'success' => 'Upah Anak Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
