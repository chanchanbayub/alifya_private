<?php

namespace App\Controllers\AHL;

use App\Controllers\BaseController;
use App\Models\Admin\PengajarModel;
use App\Models\AHL\AbsensiAHLModel;
use App\Models\Ahl\MitraPengajarAhlModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class AbsensiAHLController extends BaseController
{
    protected $pengajarModel;
    protected $validation;
    protected $mitraPengajarAhl;
    // protected $kelompokBelajarModel;
    protected $absensiAhlModel;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->absensiAhlModel = new AbsensiAHLModel();
        $this->validation = \Config\Services::validation();
        // $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->mitraPengajarAhl = new MitraPengajarAhlModel();
        helper(['format']);
    }

    public function index()
    {

        $mitra_pengajar = $this->mitraPengajarAhl->getMitraPengajarAhl();

        $data = [
            'title' => 'Absensi Mitra',
            'absensi' => $this->absensiAhlModel->getAbsensiAhl(),
            'mitra_pengajar' => $mitra_pengajar,
        ];

        return view('ahl/absensi_ahl_v', $data);
    }

    public function getAbsensiMitraAhl()
    {
        if ($this->request->isAjax()) {
            $absensi = $this->absensiAhlModel->getAbsensiMitraAhl();

            return DataTable::of($absensi)
                ->add('action', function ($row) {
                    return '<button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                            <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>';
                })
                ->setSearchableColumns(['nama_lengkap', 'tanggal', 'keterangan'])
                ->addNumbering('no')->toJson(true);
        }
    }


    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'tanggal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Tidak Boleh Kosong !'
                    ]
                ],
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !'
                    ]
                ],

                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'tanggal' => $this->validation->getError('tanggal'),
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'keterangan' => $this->validation->getError('keterangan'),
                    ]
                ];
            } else {

                $tanggal = $this->request->getPost('tanggal');
                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $keterangan = $this->request->getPost('keterangan');

                $cek_data = $this->absensiAhlModel->where(["mitra_pengajar_id" => $mitra_pengajar_id])->where(["tanggal" => $tanggal])->first();

                if ($cek_data != null) {
                    $alert = [
                        'duplikat' => 'Tanggal sudah tersimpan di database'
                    ];
                } else {
                    $this->absensiAhlModel->save([
                        'tanggal' => strtolower($tanggal),
                        'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                        'keterangan' => strtolower($keterangan),

                    ]);

                    $alert = [
                        'success' => 'Absensi Berhasil di Simpan !'
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

            $absensi = $this->absensiAhlModel->getDataAbsensiAhl($id);

            $mitra_pengajar = $this->mitraPengajarAhl->getMitraPengajarAhl();

            $data = [
                'absensi' => $absensi,
                'mitra_pengajar' => $mitra_pengajar,
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $absensi = $this->absensiAhlModel->where(["id" => $id])->first();

            $this->absensiAhlModel->delete($absensi["id"]);

            $alert = [
                'success' => 'Absensi Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'tanggal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Tidak Boleh Kosong !'
                    ]
                ],
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !'
                    ]
                ],

                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'tanggal' => $this->validation->getError('tanggal'),
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'keterangan' => $this->validation->getError('keterangan'),
                        'pergantian_jadwal' => $this->validation->getError('pergantian_jadwal'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $tanggal = $this->request->getPost('tanggal');
                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $keterangan = $this->request->getPost('keterangan');


                $this->absensiAhlModel->update($id, [
                    'tanggal' => strtolower($tanggal),
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'keterangan' => strtolower($keterangan),
                ]);

                $alert = [
                    'success' => 'Absensi Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
