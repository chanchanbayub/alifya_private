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
                ->add('action', function ($row) {
                    return '<button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                            <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>';
                })
                ->setSearchableColumns(['nama_lengkap_anak', 'bulan', 'harga', 'tahun'])
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
                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'harga' => $this->validation->getError('harga'),
                        'bulan' => $this->validation->getError('bulan'),

                    ]
                ];
            } else {

                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $harga = $this->request->getPost('harga');
                $bulan = $this->request->getPost('bulan');

                $tahun = date('Y');

                $this->hargaModel->save([
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'harga' => strtolower($harga),
                    'bulan' => $bulan,
                    'tahun' => $tahun

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
                        'required' => 'Peserta Didik Tidak Boleh Kosong !'
                    ]
                ],

                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Tidak Boleh Kosong !'
                    ]
                ],

                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harga Tidak Boleh Kosong !'
                    ]
                ],


            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'harga' => $this->validation->getError('harga'),
                        'bulan' => $this->validation->getError('bulan'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');

                $peserta_didik_id = $this->request->getPost('peserta_didik_id');

                $bulan = $this->request->getPost('bulan');

                $tahun = $this->request->getPost('tahun');

                $harga = $this->request->getPost('harga');

                if ($tahun == null) {
                    $tahun = date('Y');
                }


                $this->hargaModel->update($id, [
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'harga' => strtolower($harga),

                ]);

                $alert = [
                    'success' => 'Upah Anak Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function update_harga()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Sebelumnya Tidak Boleh Kosong !'
                    ]
                ],
                'bulan_update' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Sekarang Tidak Boleh Kosong !'
                    ]
                ]
            ])) {
                $alert = [
                    'error' => [
                        'bulan' => $this->validation->getError('bulan'),
                        'bulan_update' => $this->validation->getError('bulan_update'),
                    ]
                ];
            } else {

                $bulan = $this->request->getPost('bulan');

                $bulan_sebelumnya = explode("-", $bulan);

                $inputan_bulan_sebelumnya = intval($bulan_sebelumnya[1]);

                $inputan_tahun_sebelumnya = intval($bulan_sebelumnya[0]);

                $bulan_update = $this->request->getPost('bulan_update');

                $bulan_terbaru = explode("-", $bulan_update);

                $inputan_bulan_terbaru = intval($bulan_terbaru[1]);
                $inputan_tahun_terbaru = intval($bulan_terbaru[0]);

                $peserta_didik = $this->muridModel->getDataMuridAktif();

                foreach ($peserta_didik as $peserta) {

                    $data_harga_bulan_sebelumnya = $this->hargaModel->where(["peserta_didik_id" => $peserta->id])->where(["bulan" => $inputan_bulan_sebelumnya])->where(["tahun" => $inputan_tahun_sebelumnya])->get()->getRowObject();

                    if ($data_harga_bulan_sebelumnya != null) {

                        $data_harga_bulan_terbaru = $this->hargaModel->where(["peserta_didik_id" => $peserta->id])->where(["bulan" => $inputan_bulan_terbaru])->where(["tahun" => $inputan_tahun_terbaru])->get()->getRowObject();

                        if ($data_harga_bulan_terbaru == null) {
                            $this->hargaModel->save([
                                'peserta_didik_id' => strtolower($data_harga_bulan_sebelumnya->peserta_didik_id),
                                'harga' => strtolower($data_harga_bulan_sebelumnya->harga),
                                'bulan' => $inputan_bulan_terbaru,
                                'tahun' => $inputan_tahun_terbaru
                            ]);
                            $alert = [
                                'success' => 'Upah Anak Berhasil di Simpan !'
                            ];
                        } elseif ($data_harga_bulan_terbaru != null) {
                            $alert = [
                                'error' => [
                                    'data' => 'Upah Bulan Tersebut Sudah terdaptar!'
                                ],
                            ];
                        }
                    } elseif ($data_harga_bulan_sebelumnya == null) {
                        $this->hargaModel->save([
                            'peserta_didik_id' => $peserta->id,
                            'harga' => "0",
                            'bulan' => $inputan_bulan_terbaru,
                            'tahun' => $inputan_tahun_terbaru
                        ]);
                        $alert = [
                            'success' => 'Upah Anak Berhasil di Simpan !'
                        ];
                    }
                }
            }

            return json_encode($alert);
        }
    }

    public function harga_perbulan()
    {
        if ($this->request->isAJAX()) {

            $bulan = $this->request->getVar('bulan');

            $data_bulan = explode("-", $bulan);

            $inputan_bulan = $data_bulan[1];
            $inputan_tahun = $data_bulan[0];

            $harga = $this->hargaModel->getHargaPerbulanData($inputan_bulan, $inputan_tahun);


            $data = [
                'harga' => $harga,
            ];

            return json_encode($data);
        }
    }
}
