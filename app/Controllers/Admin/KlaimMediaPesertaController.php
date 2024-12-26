<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HargaModel;
use App\Models\Admin\JenisMediaBelajarModel;
use App\Models\Admin\KlaimMediaPesertaModel;
use App\Models\Admin\MuridModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class KlaimMediaPesertaController extends BaseController
{
    protected $hargaModel;
    protected $muridModel;
    protected $jenisMediaBelajarModel;
    protected $klaimMediaBelajarModel;
    protected $validation;

    public function __construct()
    {
        $this->hargaModel = new HargaModel();
        $this->muridModel = new MuridModel();
        $this->jenisMediaBelajarModel = new JenisMediaBelajarModel();
        $this->validation = \Config\Services::validation();
        $this->klaimMediaBelajarModel = new KlaimMediaPesertaModel();
    }

    public function index()
    {

        $peserta_didik = $this->muridModel->getDataMuridAktif();

        $data = [
            'title' => 'Klaim Media Belajar',
            'peserta_didik' => $peserta_didik,
            'jenis_media' => $this->jenisMediaBelajarModel->getJenisMediaBelajar()
        ];

        return view('admin/klaim_media_v', $data);
    }

    public function getDataHargaMedia()
    {
        if ($this->request->isAjax()) {
            $klaim_media = $this->klaimMediaBelajarModel->getHargaMedia();

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
                                                </button>
                            <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>';
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

            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'bulan' => $this->validation->getError('bulan'),
                        'jenis_media_id' => $this->validation->getError('jenis_media_id'),
                        'harga_media' => $this->validation->getError('harga_media'),
                        'lain_lain' => $this->validation->getError('lain_lain'),

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
}
