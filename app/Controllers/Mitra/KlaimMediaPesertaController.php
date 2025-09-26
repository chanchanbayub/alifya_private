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
                ->add('action', function ($row) {
                    return '<button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>';
                })
                ->setSearchableColumns(['nama_lengkap_anak', 'bulan', 'harga_media', 'nama_media', 'tahun'])
                ->addNumbering('no')->toJson(true);
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
                $faktur = $this->request->getFile('faktur');

                if ($faktur->getError() == 4) {
                    $namaFaktur = $faktur_lama;
                } else {
                    $namaFaktur = $faktur->getRandomName();
                    $faktur->move('faktur', $namaFaktur);
                }

                $media = $this->klaimMediaBelajarModel->where(["id" => $id])->get()->getRowObject();

                if ($media->lain_lain == null) {
                    $input_lain_lain = intval(0);
                } else {
                    $input_lain_lain = intval($media->lain_lain);
                }

                $this->klaimMediaBelajarModel->update($id, [
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'bulan' => strtolower($bulan),
                    'tahun' => strtolower($tahun),
                    'jenis_media_id' => $jenis_media_id,
                    'harga_media' => $harga_media,
                    'lain_lain' => $input_lain_lain,
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
