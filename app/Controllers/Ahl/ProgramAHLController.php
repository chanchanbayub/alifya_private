<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\AhlProgramAHLModel;
use App\Models\Ahl\ProgramAHLModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProgramAHLController extends BaseController
{
    protected $programAHLModel;
    protected $validation;

    public function __construct()
    {
        $this->programAHLModel = new ProgramAHLModel();
        $this->validation = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'title' => 'Program Belajar AHL',
            'program_ahl' => $this->programAHLModel->getProgramAHL()
        ];

        return view('ahl/program_ahl_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_program' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Program Tidak Boleh Kosong!'
                    ]
                ],
                'usia_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Usia Anak Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_program' => $this->validation->getError('nama_program'),
                        'usia_anak' => $this->validation->getError('usia_anak'),

                    ]
                ];
            } else {

                $nama_program = $this->request->getPost('nama_program');
                $usia_anak = $this->request->getPost('usia_anak');

                $this->programAHLModel->save([
                    'nama_program' => strtolower($nama_program),
                    'usia_anak' => strtolower($usia_anak),

                ]);

                $alert = [
                    'success' => 'Program Belajar AHL Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $program = $this->programAHLModel->where(["id" => $id])->first();

            return json_encode($program);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $program = $this->programAHLModel->where(["id" => $id])->first();

            $this->programAHLModel->delete($program["id"]);

            $alert = [
                'success' => 'Program Belajar Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_program' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Program Tidak Boleh Kosong!'
                    ]
                ],
                'usia_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Usia Anak Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nama_program' => $this->validation->getError('nama_program'),
                        'usia_anak' => $this->validation->getError('usia_anak'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $nama_program = $this->request->getPost('nama_program');
                $usia_anak = $this->request->getPost('usia_anak');

                $this->programAHLModel->update($id, [
                    'nama_program' => strtolower($nama_program),
                    'usia_anak' => strtolower($usia_anak),

                ]);

                $alert = [
                    'success' => 'Program Belajar Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
