<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KlaimLainLainMitraModel;
use App\Models\Admin\PengajarModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class KlaimLainLainMitraController extends BaseController
{
    protected $pengajarModel;
    protected $klaimLainLainModel;
    protected $validation;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->klaimLainLainModel = new KlaimLainLainMitraModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $mitra_pengajar = $this->pengajarModel->getDataPengajarStatusAktif();

        $data = [
            'title' => 'Klaim Lain Lain',
            'mitra_pengajar' => $mitra_pengajar,
        ];

        return view('admin/lain_lain_v', $data);
    }

    public function getLainLain()
    {
        if ($this->request->isAjax()) {
            $lain_lain = $this->klaimLainLainModel->getLainLain();


            return DataTable::of($lain_lain)
                ->add('action', function ($row) {
                    return '<button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                            <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>';
                })
                ->setSearchableColumns(['nama_lengkap', 'bulan', 'lain_lain', 'tahun'])
                ->addNumbering('no')->toJson(true);
        }
    }

    public function update_lain_lain()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'bulan' => $this->validation->getError('bulan'),
                    ]
                ];
            } else {
                $bulan = $this->request->getPost('bulan');
                $tahun = date('Y');

                $mitra_pengajar = $this->pengajarModel->getDataPengajarStatusAktif();
                // dd($peserta_didik);

                foreach ($mitra_pengajar as $mitra_pengajar) {

                    $data_lain_lain = $this->klaimLainLainModel->where(["mitra_pengajar_id" => $mitra_pengajar->id])->orderBy('id')->get()->getRowObject();

                    if ($data_lain_lain != null) {
                        $data_lain_lain_berdasarkan_bulan = $this->klaimLainLainModel->where(["mitra_pengajar_id" => $data_lain_lain->mitra_pengajar_id])->where(["bulan" => $bulan])->where(["tahun" => $tahun])->get()->getRowObject();

                        if ($data_lain_lain_berdasarkan_bulan == null) {
                            $this->klaimLainLainModel->save([
                                'mitra_pengajar_id' => strtolower($mitra_pengajar->id),
                                'bulan' => $bulan,
                                'tahun' => $tahun,
                                'lain_lain' => intval(0),
                                'booster_media_mitra' => intval(0)
                            ]);
                            $alert = [
                                'success' => 'Lain Lain Berhasil di Simpan !'
                            ];
                        } elseif ($data_lain_lain != null) {
                            $alert = [
                                'error' => [
                                    'data' => 'Lain Lain Tersebut Sudah terdaptar!'
                                ],
                            ];
                        }
                    } elseif ($data_lain_lain == null) {

                        $data_lain_lain_berdasarkan_bulan = $this->klaimLainLainModel->where(["mitra_pengajar_id" => $data_lain_lain])->where(["bulan" => $bulan])->where(["tahun" => $tahun])->get()->getRowObject();

                        if ($data_lain_lain_berdasarkan_bulan == null) {
                            $this->klaimLainLainModel->save([
                                'mitra_pengajar_id' => strtolower($mitra_pengajar->id),
                                'bulan' => $bulan,
                                'tahun' => $tahun,
                                'lain_lain' => intval(0),
                                'booster_media_mitra' => intval(0)
                            ]);
                            $alert = [
                                'success' => 'Lain Lain Berhasil di Simpan !'
                            ];
                        } elseif ($data_lain_lain != null) {
                            $alert = [
                                'error' => [
                                    'data' => 'Lain Lain Tersebut Sudah terdaptar!'
                                ],
                            ];
                        }
                    } else {
                        $alert = [
                            'error' => [
                                'data' => 'Lain Lain Bulan Tersebut Sudah terdaptar!'
                            ],
                        ];
                    }
                }
            }

            return json_encode($alert);
        }
    }

    public function getLainLainPerbulan()
    {
        if ($this->request->isAJAX()) {

            $bulan = $this->request->getVar('bulan');

            $data_bulan = explode("-", $bulan);

            $inputan_bulan = intval($data_bulan[1]);

            $inputan_tahun = intval($data_bulan[0]);

            $lain_lain = $this->klaimLainLainModel->getLainLainPerbulanData($inputan_bulan, $inputan_tahun);

            $data = [
                'lain_lain' => $lain_lain,
            ];

            return json_encode($data);
        }
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_pengajar_id' => [
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
                'lain_lain' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],
                'booster_media_mitra' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'lain_lain' => $this->validation->getError('lain_lain'),
                        'bulan' => $this->validation->getError('bulan'),
                        'booster_media_mitra' => $this->validation->getError('booster_media_mitra'),

                    ]
                ];
            } else {

                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $lain_lain = $this->request->getPost('lain_lain');
                $booster_media_mitra = $this->request->getPost('booster_media_mitra');
                $bulan = $this->request->getPost('bulan');

                $tahun = date('Y');

                $data_lain_lain = $this->klaimLainLainModel->where(["mitra_pengajar_id" => $mitra_pengajar_id])->where(["bulan" => $bulan])->where(["tahun" => $tahun])->first();

                if ($data_lain_lain == null) {

                    $this->klaimLainLainModel->save([
                        'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                        'lain_lain' => strtolower($lain_lain),
                        'booster_media_mitra' => strtolower($booster_media_mitra),
                        'bulan' => $bulan,
                        'tahun' => $tahun

                    ]);

                    $alert = [
                        'success' => 'Lain Lain Berhasil di Simpan !'
                    ];
                } else {
                    $alert = [
                        'error_data' => 'Lain Lain Sudah Ada !'
                    ];
                }
            }
            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $lain_lain = $this->klaimLainLainModel->where(["id" => $id])->first();
            $mitra_pengajar = $this->pengajarModel->getDataPengajarStatusAktif();

            $data = [
                'lain_lain' => $lain_lain,
                'mitra_pengajar' => $mitra_pengajar,
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $lain_lain = $this->klaimLainLainModel->where(["id" => $id])->first();

            $this->klaimLainLainModel->delete($lain_lain["id"]);

            $alert = [
                'success' => 'Lain Lain Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !'
                    ]
                ],

                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Tidak Boleh Kosong !'
                    ]
                ],

                'lain_lain' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'lain_lain Tidak Boleh Kosong !'
                    ]
                ],

                'booster_media_mitra' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'lain_lain Tidak Boleh Kosong !'
                    ]
                ],


            ])) {
                $alert = [
                    'error' => [
                        'mitra_pengajar' => $this->validation->getError('mitra_pengajar'),
                        'lain_lain' => $this->validation->getError('lain_lain'),
                        'booster_media_mitra' => $this->validation->getError('booster_media_mitra'),
                        'bulan' => $this->validation->getError('bulan'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');

                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');

                $bulan = $this->request->getPost('bulan');

                $tahun = $this->request->getPost('tahun');

                $lain_lain = $this->request->getPost('lain_lain');
                $booster_media_mitra = $this->request->getPost('booster_media_mitra');

                if ($tahun == null) {
                    $tahun = date('Y');
                }


                $this->klaimLainLainModel->update($id, [
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'lain_lain' => strtolower($lain_lain),
                    'booster_media_mitra' => strtolower($booster_media_mitra),

                ]);

                $alert = [
                    'success' => 'Lain Lain Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
