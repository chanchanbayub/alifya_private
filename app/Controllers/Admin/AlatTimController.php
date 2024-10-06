<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AlatTimModel;
use CodeIgniter\HTTP\ResponseInterface;

class AlatTimController extends BaseController
{
    protected $alatTimModel;
    protected $validation;


    public function __construct()
    {
        $this->alatTimModel = new AlatTimModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Alat Tim',
            'alat_tim' => $this->alatTimModel->getAlatTim()
        ];

        return view('admin/alat_tim_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keterangan Tidak Boleh Kosong !'
                    ]
                ],
                'links' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'links Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'keterangan' => $this->validation->getError('keterangan'),
                        'links' => $this->validation->getError('links'),
                    ]
                ];
            } else {

                $keterangan = $this->request->getPost('keterangan');
                $links = $this->request->getPost('links');

                $this->alatTimModel->save([
                    'keterangan' => strtolower($keterangan),
                    'links' => $links
                    // 'links' => mysqli_real($links),
                ]);

                $alert = [
                    'success' => 'Alat Tim Berhasil diSimpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $alat_tim = $this->alatTimModel->where(["id" => $id])->first();

            $data = [
                'alat_tim' => $alat_tim,
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $alat_pengajaran = $this->alatTimModel->where(["id" => $id])->first();

            $this->alatTimModel->delete($alat_pengajaran["id"]);

            $alert = [
                'success' => 'Alat Tim Berhasil diHapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([

                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keterangan Tidak Boleh Kosong !'
                    ]
                ],
                'links' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'links Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'keterangan' => $this->validation->getError('keterangan'),
                        'links' => $this->validation->getError('links'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $keterangan = $this->request->getPost('keterangan');
                $links = $this->request->getPost('links');

                $this->alatTimModel->update($id, [
                    'keterangan' => strtolower($keterangan),
                    'links' => $links,
                ]);

                $alert = [
                    'success' => 'Alat Tim Berhasil diUpdate!'
                ];
            }

            return json_encode($alert);
        }
    }
}
