<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\LainLainPesertaAHLModel;
use App\Models\Ahl\PesertaDidikAhlModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class LainLainPesertaAHLController extends BaseController
{
    protected $pesertaDidikAhlModel;
    protected $lainlainPesertaAhlModel;
    protected $validation;

    public function __construct()
    {
        $this->pesertaDidikAhlModel = new PesertaDidikAhlModel();
        $this->lainlainPesertaAhlModel = new LainLainPesertaAHLModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $peserta_didik_ahl = $this->pesertaDidikAhlModel->getPesertaDidikAhl();

        $data = [
            'title' => 'Klaim Lain Lain Peserta AHL',
            'peserta_didik_ahl' => $peserta_didik_ahl,
        ];

        return view('ahl/lain_lain_v', $data);
    }

    public function getLainLain()
    {
        if ($this->request->isAjax()) {
            $lain_lain = $this->lainlainPesertaAhlModel->getLainLainAhl();

            return DataTable::of($lain_lain)
                ->add('action', function ($row) {
                    return '<button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                            <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>';
                })
                ->setSearchableColumns(['nama_lengkap_anak', 'bulan', 'lain_lain', 'tahun'])
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
                $bulan = $this->request->getVar('bulan');

                $data_bulan = explode("-", $bulan);

                $inputan_bulan = intval($data_bulan[1]);
                // dd($inputan_bulan);
                $inputan_tahun = intval($data_bulan[0]);

                $peserta_didik_ahl = $this->pesertaDidikAhlModel->getPesertaDidikAhlInvoice();
                // dd($peserta_didik);

                foreach ($peserta_didik_ahl as $peserta_didik_ahl) {

                    $data_lain_lain = $this->lainlainPesertaAhlModel->where(["peserta_didik_ahl_id" => $peserta_didik_ahl->id])->orderBy('id')->get()->getRowObject();

                    if ($data_lain_lain != null) {
                        $data_lain_lain_berdasarkan_bulan = $this->lainlainPesertaAhlModel->where(["peserta_didik_ahl_id" => $data_lain_lain->peserta_didik_ahl_id])->where(["bulan" => $inputan_bulan])->where(["tahun" => $inputan_tahun])->get()->getRowObject();

                        if ($data_lain_lain_berdasarkan_bulan == null) {
                            $this->lainlainPesertaAhlModel->save([
                                'peserta_didik_ahl_id' => strtolower($peserta_didik_ahl->id),
                                'bulan' => $inputan_bulan,
                                'tahun' => $inputan_tahun,
                                'lain_lain' => intval(0),
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

                        $data_lain_lain_berdasarkan_bulan = $this->lainlainPesertaAhlModel->where(["peserta_didik_ahl_id" => $data_lain_lain])->where(["bulan" => $inputan_bulan])->where(["tahun" => $inputan_tahun])->get()->getRowObject();

                        if ($data_lain_lain_berdasarkan_bulan == null) {
                            $this->lainlainPesertaAhlModel->save([
                                'peserta_didik_ahl_id' => strtolower($peserta_didik_ahl->id),
                                'bulan' => $inputan_bulan,
                                'tahun' => $inputan_tahun,
                                'lain_lain' => intval(0),
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

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'peserta_didik_ahl_id' => [
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
                'lain_lain' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lain Lain Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_ahl_id' => $this->validation->getError('peserta_didik_ahl_id'),
                        'lain_lain' => $this->validation->getError('lain_lain'),
                        'bulan' => $this->validation->getError('bulan'),
                    ]
                ];
            } else {

                $bulan = $this->request->getVar('bulan');

                $data_bulan = explode("-", $bulan);

                $inputan_bulan = intval($data_bulan[1]);
                // dd($inputan_bulan);
                $inputan_tahun = intval($data_bulan[0]);

                $peserta_didik_ahl = $this->pesertaDidikAhlModel->getPesertaDidikAhlInvoice();

                foreach ($peserta_didik_ahl as $peserta_didik_ahl) {

                    $data_lain_lain = $this->lainlainPesertaAhlModel->where(["peserta_didik_ahl_id" => $peserta_didik_ahl->id])->where(["bulan" => $inputan_bulan])->where(["tahun" => $inputan_tahun])->first();

                    if ($data_lain_lain == null) {
                        $this->lainlainPesertaAhlModel->save([
                            'peserta_didik_ahl_id' => strtolower($peserta_didik_ahl->id),
                            'bulan' => $inputan_bulan,
                            'tahun' => $inputan_tahun,
                            'lain_lain' => intval(0),
                        ]);
                        $alert = [
                            'success' => 'Lain Lain Berhasil di Simpan !'
                        ];
                    } else {
                        $alert = [
                            'data' => 'Lain Lain Tersebut Sudah terdaptar!'
                        ];
                    }
                }
            }
            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $lain_lain = $this->lainlainPesertaAhlModel->where(["id" => $id])->first();
            $peserta_didik = $this->pesertaDidikAhlModel->getPesertaDidikAhlInvoice();

            $data = [
                'lain_lain' => $lain_lain,
                'peserta_didik' => $peserta_didik,
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $lain_lain = $this->lainlainPesertaAhlModel->where(["id" => $id])->first();

            $this->lainlainPesertaAhlModel->delete($lain_lain["id"]);

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
                'peserta_didik_ahl_id' => [
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

            ])) {
                $alert = [
                    'error' => [
                        'mitra_pengajar' => $this->validation->getError('mitra_pengajar'),
                        'lain_lain' => $this->validation->getError('lain_lain'),
                        'bulan' => $this->validation->getError('bulan'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');

                $peserta_didik_ahl_id = $this->request->getPost('peserta_didik_ahl_id');

                $bulan = $this->request->getPost('bulan');

                $tahun = $this->request->getPost('tahun');

                $lain_lain = $this->request->getPost('lain_lain');


                if ($tahun == null) {
                    $tahun = date('Y');
                }

                $this->lainlainPesertaAhlModel->update($id, [
                    'peserta_didik_ahl_id' => strtolower($peserta_didik_ahl_id),
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'lain_lain' => strtolower($lain_lain),

                ]);

                $alert = [
                    'success' => 'Lain Lain Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }

    // public function getLainLainPerbulan()
    // {
    //     if ($this->request->isAJAX()) {

    //         $bulan = $this->request->getVar('bulan');

    //         $data_bulan = explode("-", $bulan);

    //         $inputan_bulan = intval($data_bulan[1]);

    //         $inputan_tahun = intval($data_bulan[0]);

    //         $lain_lain = $this->klaimLainLainModel->getLainLainPerbulanData($inputan_bulan, $inputan_tahun);

    //         $data = [
    //             'lain_lain' => $lain_lain,
    //         ];

    //         return json_encode($data);
    //     }
    // }
}
