<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Admin\PengajarModel;
use App\Models\Ahl\LayananAHLModel;
use App\Models\Ahl\MitraPengajarAhlModel;
use CodeIgniter\HTTP\ResponseInterface;

class MitraPengajarAhlController extends BaseController
{
    protected $pengajarModel;
    protected $layananAhlModel;
    protected $mitraPengajarAhlModel;
    protected $validation;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->layananAhlModel = new LayananAHLModel();
        $this->mitraPengajarAhlModel = new MitraPengajarAhlModel();
        $this->validation = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'title' => 'Mitra Pengajar AHL',
            'pengajar' => $this->pengajarModel->getDataPengajarStatusAktif(),
            'layanan' => $this->layananAhlModel->getLayananAhl(),
            'mitra_pengajar_ahl' => $this->mitraPengajarAhlModel->getMitraPengajarAhl()
        ];

        return view('ahl/mitra_ahl_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong!'
                    ]
                ],

                'jenis_layanan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Layanan Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_id' => $this->validation->getError('mitra_id'),
                        'jenis_layanan_id' => $this->validation->getError('jenis_layanan_id'),

                    ]
                ];
            } else {

                $mitra_id = $this->request->getPost('mitra_id');
                $jenis_layanan_id = $this->request->getPost('jenis_layanan_id');

                $this->mitraPengajarAhlModel->save([
                    'mitra_id' => strtolower($mitra_id),
                    'jenis_layanan_id' => strtolower($jenis_layanan_id),

                ]);

                $alert = [
                    'success' => 'Mitra Pengajar Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $layanan = $this->layananAhlModel->getLayananAhl();
            $pengajar = $this->pengajarModel->getDataPengajarStatusAktif();
            $mitra_pengajar_ahl = $this->mitraPengajarAhlModel->where(["id" => $id])->first();

            $data = [
                'layanan' => $layanan,
                'pengajar' => $pengajar,
                'mitra_ahl' => $mitra_pengajar_ahl
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $mitra_pengajar_ahl = $this->mitraPengajarAhlModel->where(["id" => $id])->first();

            $this->mitraPengajarAhlModel->delete($mitra_pengajar_ahl["id"]);

            $alert = [
                'success' => 'Jadwal Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'mitra_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong!'
                    ]
                ],

                'jenis_layanan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Layanan Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_id' => $this->validation->getError('mitra_id'),
                        'jenis_layanan_id' => $this->validation->getError('jenis_layanan_id'),

                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $mitra_id = $this->request->getPost('mitra_id');
                $jenis_layanan_id = $this->request->getPost('jenis_layanan_id');

                $this->mitraPengajarAhlModel->update($id, [
                    'mitra_id' => strtolower($mitra_id),
                    'jenis_layanan_id' => strtolower($jenis_layanan_id),

                ]);

                $alert = [
                    'success' => 'Mitra Pengajar Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
