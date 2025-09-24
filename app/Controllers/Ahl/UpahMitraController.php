<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\MitraPengajarAhlModel;
use App\Models\Ahl\UpahMitraModel;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;
use Hermawan\DataTables\DataTable;

class UpahMitraController extends BaseController
{
    protected $mitraPengajarAhlModel;
    protected $upahMitraModel;
    protected $validation;

    public function __construct()
    {
        $this->mitraPengajarAhlModel = new MitraPengajarAhlModel();
        $this->upahMitraModel = new UpahMitraModel();
        $this->validation = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'title' => 'Mitra Pengajar AHL',
            'mitra_pengajar_ahl' => $this->mitraPengajarAhlModel->getMitraPengajarAhl(),
            'upah_mitra' => $this->upahMitraModel->getUpahMitraAhl()
        ];

        return view('ahl/upah_mitra_ahl_v', $data);
    }

    public function getUpahAhl()
    {
        if ($this->request->isAjax()) {
            $upah = $this->upahMitraModel->getUpahMitra();

            return DataTable::of($upah)
                ->add('action', function ($row) {
                    return '<button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                            <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>';
                })
                ->setSearchableColumns(['nama_lengkap', 'bulan', 'upah_mitra', 'lain_lain'])
                ->addNumbering('no')->toJson(true);
        }
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_ahl_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],

                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],
                'upah_mitra' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],
                'lain_lain' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_ahl_id' => $this->validation->getError('mitra_ahl_id'),
                        'bulan' => $this->validation->getError('bulan'),
                        'upah_mitra' => $this->validation->getError('upah_mitra'),
                        'lain_lain' => $this->validation->getError('lain_lain'),

                    ]
                ];
            } else {

                $mitra_ahl_id = $this->request->getPost('mitra_ahl_id');
                $bulan = $this->request->getPost('bulan');
                $upah_mitra = $this->request->getPost('upah_mitra');
                $lain_lain = $this->request->getPost('lain_lain');

                // $data_bulan = date_create($bulan);

                $time = new DateTime($bulan);

                $bulan_ini = $time->format('Y-m-d');

                $this->upahMitraModel->save([
                    'mitra_ahl_id' => strtolower($mitra_ahl_id),
                    'bulan' => strtolower($bulan_ini),
                    'upah_mitra' => strtolower($upah_mitra),
                    'lain_lain' => strtolower($lain_lain),
                ]);

                $alert = [
                    'success' => 'Upah Mitra Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $upah_mitra = $this->upahMitraModel->where(["id" => $id])->first();

            $bulan_tahun = date('Y-m', strtotime($upah_mitra["bulan"]));

            $mitra_pengajar_ahl = $this->mitraPengajarAhlModel->getMitraPengajarAhl();

            $data = [
                'upah_mitra' => $upah_mitra,
                'mitra_ahl' => $mitra_pengajar_ahl,
                'bulan_tahun' => $bulan_tahun
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $upah_mitra = $this->upahMitraModel->where(["id" => $id])->first();

            $this->upahMitraModel->delete($upah_mitra["id"]);

            $alert = [
                'success' => 'Upah Mitra Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'mitra_ahl_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],

                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],
                'upah_mitra' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],
                'lain_lain' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_ahl_id' => $this->validation->getError('mitra_ahl_id'),
                        'bulan' => $this->validation->getError('bulan'),
                        'upah_mitra' => $this->validation->getError('upah_mitra'),
                        'lain_lain' => $this->validation->getError('lain_lain'),

                    ]
                ];
            } else {
                $id = $this->request->getVar('id');
                $mitra_ahl_id = $this->request->getPost('mitra_ahl_id');
                $bulan = $this->request->getPost('bulan');
                $upah_mitra = $this->request->getPost('upah_mitra');
                $lain_lain = $this->request->getPost('lain_lain');

                // $data_bulan = date_create($bulan);

                $time = new DateTime($bulan);

                $bulan_ini = $time->format('Y-m-d');

                $this->upahMitraModel->update($id, [
                    'mitra_ahl_id' => strtolower($mitra_ahl_id),
                    'bulan' => strtolower($bulan_ini),
                    'upah_mitra' => strtolower($upah_mitra),
                    'lain_lain' => strtolower($lain_lain),
                ]);

                $alert = [
                    'success' => 'Upah Mitra Berhasil di Ubah!'
                ];
            }

            return json_encode($alert);
        }
    }
}
