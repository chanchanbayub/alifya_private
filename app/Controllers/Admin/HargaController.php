<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HargaModel;
use App\Models\Admin\JenisMediaBelajarModel;
use App\Models\Admin\MuridModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class HargaController extends BaseController
{
    protected $hargaModel;
    protected $muridModel;
    protected $jenisMediaBelajarModel;
    protected $validation;

    public function __construct()
    {
        $this->hargaModel = new HargaModel();
        $this->muridModel = new MuridModel();
        $this->jenisMediaBelajarModel = new JenisMediaBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $peserta_didik = $this->muridModel->getDataMuridAktif();

        $data = [
            'title' => 'Upah Perjam',
            'peserta_didik' => $peserta_didik,
            'jenis_media' => $this->jenisMediaBelajarModel->getJenisMediaBelajar()
        ];

        return view('admin/harga_v', $data);
    }

    public function getDataHarga()
    {
        if ($this->request->isAjax()) {
            $harga_perjam = $this->hargaModel->getHarga();

            return DataTable::of($harga_perjam)
                ->add('faktur', function ($row) {
                    if ($row->faktur != null) {
                        return '<a href ="/faktur/' . $row->faktur . '" class="btn btn-link btn-sm" target="_blank">Lihat Faktur </a>';
                    } else {
                        return '<small> - </small>';
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
                ->setSearchableColumns(['nama_lengkap_anak', 'bulan', 'harga', 'nama_media'])

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

                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
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
                        'harga' => $this->validation->getError('harga'),
                        'media_belajar' => $this->validation->getError('media_belajar'),

                    ]
                ];
            } else {

                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $harga = $this->request->getPost('harga');
                $media_belajar = $this->request->getPost('media_belajar');

                $this->hargaModel->save([
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'harga' => strtolower($harga),
                    'media_belajar' => strtolower($media_belajar),

                ]);

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
                'peserta_didik' => $peserta_didik,
                'jenis_media' => $this->jenisMediaBelajarModel->getJenisMediaBelajar()
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $harga = $this->hargaModel->where(["id" => $id])->first();

            $path_foto = 'faktur/' . $harga['faktur'];

            $this->hargaModel->delete($harga["id"]);

            $alert = [
                'success' => 'Upah Berhasil di Hapus !'
            ];

            if ($harga['faktur'] != null) {
                if (file_exists($path_foto)) {
                    unlink($path_foto);
                }
            }

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
                        'media_belajar' => $this->validation->getError('media_belajar'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');

                $faktur_lama = $this->request->getPost('faktur_lama');

                $peserta_didik_id = $this->request->getPost('peserta_didik_id');

                $bulan = $this->request->getPost('bulan');

                $jenis_media_id = $this->request->getPost('jenis_media_id');

                $media_belajar = $this->request->getPost('media_belajar');

                $tahun = $this->request->getPost('tahun');

                $harga = $this->request->getPost('harga');

                $faktur = $this->request->getFile('faktur');

                $path_foto_lama = 'faktur/' . $faktur_lama;

                if ($faktur->getError() == 4) {
                    $nama_foto = $faktur_lama;
                } else {
                    if (file_exists($path_foto_lama)) {
                        unlink($path_foto_lama);
                    }
                    $nama_foto = $faktur->getRandomName();
                    $faktur->move('faktur', $nama_foto);
                }


                $this->hargaModel->update($id, [
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'jenis_media_id' => strtolower($jenis_media_id),
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'harga' => strtolower($harga),
                    'media_belajar' => strtolower($media_belajar),
                    'faktur' => strtolower($nama_foto),

                ]);

                $alert = [
                    'success' => 'Upah Anak Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
