<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Database\Migrations\JenisPekerjaanTable;
use App\Models\Ahl\JenisPekerjaanModel;
use CodeIgniter\HTTP\ResponseInterface;

class JenisPekerjaanController extends BaseController
{
    protected $jenisPekerjaanModel;
    protected $validation;

    public function __construct()
    {
        $this->jenisPekerjaanModel = new JenisPekerjaanModel();
        $this->validation = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'title' => 'Jenis Pekerjaan',
            'jenis_pekerjaan' => $this->jenisPekerjaanModel->getJenisPekerjaan()
        ];

        return view('ahl/jenis_pekerjaan_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'jenis_pekerjaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Pekerjaan Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'jenis_pekerjaan' => $this->validation->getError('jenis_pekerjaan'),

                    ]
                ];
            } else {

                $jenis_pekerjaan = $this->request->getPost('jenis_pekerjaan');

                $this->jenisPekerjaanModel->save([
                    'jenis_pekerjaan' => strtolower($jenis_pekerjaan),

                ]);

                $alert = [
                    'success' => 'Jenis Pekerjaan Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $jenis_pekerjaan = $this->jenisPekerjaanModel->where(["id" => $id])->first();

            return json_encode($jenis_pekerjaan);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $jenis_pekerjaan = $this->jenisPekerjaanModel->where(["id" => $id])->first();

            $this->jenisPekerjaanModel->delete($jenis_pekerjaan["id"]);

            $alert = [
                'success' => 'Jenis Pekerjaan Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'jenis_pekerjaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'jenis_pekerjaan Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'jenis_pekerjaan' => $this->validation->getError('jenis_pekerjaan'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $jenis_pekerjaan = $this->request->getPost('jenis_pekerjaan');

                $this->jenisPekerjaanModel->update($id, [
                    'jenis_pekerjaan' => strtolower($jenis_pekerjaan),

                ]);

                $alert = [
                    'success' => 'Jenis Pekerjaan Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
