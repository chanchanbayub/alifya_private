<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\MateriBelajarModel;
use App\Models\Admin\ProgramBelajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class MateriBelajarController extends BaseController
{
    protected $materiBelajarModel;
    protected $programBelajarModel;
    protected $validation;

    public function __construct()
    {
        $this->materiBelajarModel = new MateriBelajarModel();
        $this->programBelajarModel = new ProgramBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Materi Belajar',
            'program_belajar' => $this->programBelajarModel->getProgramBelajar(),
            'materi_belajar' => $this->materiBelajarModel->getMateriBelajar()
        ];

        return view('admin/materi_belajar_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'level' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Level Tidak Boleh Kosong !'
                    ]
                ],
                'program_belajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'program_belajar_id Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'level' => $this->validation->getError('level'),
                        'program_belajar_id' => $this->validation->getError('program_belajar_id'),
                    ]
                ];
            } else {

                $level = $this->request->getPost('level');
                $program_belajar_id = $this->request->getPost('program_belajar_id');

                $this->materiBelajarModel->save([
                    'level' => strtolower($level),
                    'program_belajar_id' => strtolower($program_belajar_id),

                ]);

                $alert = [
                    'success' => 'Materi Belajar Berhasil diSimpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $materi = $this->materiBelajarModel->where(["id" => $id])->first();

            $program_belajar = $this->programBelajarModel->getProgramBelajar();

            $data = [
                'materi' => $materi,
                'program_belajar' => $program_belajar
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $materi = $this->materiBelajarModel->where(["id" => $id])->first();

            $this->materiBelajarModel->delete($materi["id"]);

            $alert = [
                'success' => 'Materi Belajar Berhasil diHapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([

                'level' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Level Tidak Boleh Kosong !'
                    ]
                ],
                'program_belajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Program Belajar Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'level' => $this->validation->getError('level'),
                        'program_belajar_id' => $this->validation->getError('program_belajar_id'),

                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $level = $this->request->getPost('level');
                $program_belajar_id = $this->request->getPost('program_belajar_id');

                $this->materiBelajarModel->update($id, [
                    'level' => strtolower($level),
                    'program_belajar_id' => strtolower($program_belajar_id),
                ]);

                $alert = [
                    'success' => 'Materi Belajar Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
