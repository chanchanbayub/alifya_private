<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\JamMasukAhlModel;
use App\Models\Ahl\JenisPekerjaanModel;
use CodeIgniter\HTTP\ResponseInterface;

class JamMasukAhlController extends BaseController
{
    protected $jamMasukAhlModel;
    protected $jenisPekerjaanModel;
    protected $validation;

    public function __construct()
    {
        $this->jamMasukAhlModel = new JamMasukAhlModel();
        $this->jenisPekerjaanModel = new JenisPekerjaanModel();
        $this->validation = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'title' => 'Jadwal AHL',
            'jadwal_ahl' => $this->jamMasukAhlModel->getJamMasukAHL(),
            'jenis_pekerjaan' => $this->jenisPekerjaanModel->getJenisPekerjaan()
        ];

        return view('ahl/jam_masuk_ahl_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'jenis_pekerjaan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Pekerjaan Tidak Boleh Kosong!'
                    ]
                ],
                'jam_masuk_ahl' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam Masuk Tidak Boleh Kosong!'
                    ]
                ],
                'jam_pulang_ahl' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam pulang Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'jenis_pekerjaan_id' => $this->validation->getError('jenis_pekerjaan_id'),
                        'jam_masuk_ahl' => $this->validation->getError('jam_masuk_ahl'),
                        'jam_pulang_ahl' => $this->validation->getError('jam_pulang_ahl'),

                    ]
                ];
            } else {

                $jenis_pekerjaan_id = $this->request->getPost('jenis_pekerjaan_id');
                $jam_masuk_ahl = $this->request->getPost('jam_masuk_ahl');
                $jam_pulang_ahl = $this->request->getPost('jam_pulang_ahl');

                $this->jamMasukAhlModel->save([
                    'jenis_pekerjaan_id' => strtolower($jenis_pekerjaan_id),
                    'jam_masuk_ahl' => strtolower($jam_masuk_ahl),
                    'jam_pulang_ahl' => strtolower($jam_pulang_ahl),

                ]);

                $alert = [
                    'success' => 'Jadwal AHL Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $jenis_pekerjaan = $this->jenisPekerjaanModel->getJenisPekerjaan();

            $jam_masuk_ahl = $this->jamMasukAhlModel->where(["id" => $id])->first();

            $data = [
                'jenis_pekerjaan' => $jenis_pekerjaan,
                'jadwal_ahl' => $jam_masuk_ahl
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $jam_masuk_ahl = $this->jamMasukAhlModel->where(["id" => $id])->first();

            $this->jamMasukAhlModel->delete($jam_masuk_ahl["id"]);

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
                'jenis_pekerjaan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Pekerjaan Tidak Boleh Kosong!'
                    ]
                ],
                'jam_masuk_ahl' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam Masuk Tidak Boleh Kosong!'
                    ]
                ],
                'jam_pulang_ahl' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam pulang Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'jenis_pekerjaan_id' => $this->validation->getError('jenis_pekerjaan_id'),
                        'jam_masuk_ahl' => $this->validation->getError('jam_masuk_ahl'),
                        'jam_pulang_ahl' => $this->validation->getError('jam_pulang_ahl'),

                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $jenis_pekerjaan_id = $this->request->getPost('jenis_pekerjaan_id');
                $jam_masuk_ahl = $this->request->getPost('jam_masuk_ahl');
                $jam_pulang_ahl = $this->request->getPost('jam_pulang_ahl');

                $this->jamMasukAhlModel->update($id, [
                    'jenis_pekerjaan_id' => strtolower($jenis_pekerjaan_id),
                    'jam_masuk_ahl' => strtolower($jam_masuk_ahl),
                    'jam_pulang_ahl' => strtolower($jam_pulang_ahl),

                ]);

                $alert = [
                    'success' => 'Jadwal AHL Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
