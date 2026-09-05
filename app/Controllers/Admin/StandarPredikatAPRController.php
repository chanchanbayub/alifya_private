<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\StandarPredikatAPRModel;
use CodeIgniter\HTTP\ResponseInterface;

class StandarPredikatAPRController extends BaseController
{
    protected $standarPredikatAprModel;
    protected $validation;

    public function __construct()
    {
        $this->standarPredikatAprModel = new StandarPredikatAPRModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        // $predikat = $this->standarPredikatAprModel->getStandarPredikat();
        // // dd($predikat);

        $data = [
            'title' => 'Standar Predikat Alifya Performance Rangking',
            'predikat' => $this->standarPredikatAprModel->getStandarPredikat()
        ];

        return view('admin/standar_predikat_apr_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'predikat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'nilai_predikat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'nilai_akhir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'predikat' => $this->validation->getError('predikat'),
                        'nilai_predikat' => $this->validation->getError('nilai_predikat'),
                        'nilai_akhir' => $this->validation->getError('nilai_akhir'),
                    ]
                ];
            } else {

                $predikat = $this->request->getPost('predikat');
                $nilai_predikat = $this->request->getPost('nilai_predikat');
                $nilai_akhir = $this->request->getPost('nilai_akhir');

                $this->standarPredikatAprModel->save([
                    'predikat' => strtolower($predikat),
                    'nilai_predikat' => strtolower($nilai_predikat),
                    'nilai_akhir' => strtolower($nilai_akhir),

                ]);

                $alert = [
                    'success' => 'Standar Predikat APR Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $standar_predikat = $this->standarPredikatAprModel->where(["id" => $id])->first();

            return json_encode($standar_predikat);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $standar_predikat = $this->standarPredikatAprModel->where(["id" => $id])->first();

            $this->standarPredikatAprModel->delete($standar_predikat["id"]);

            $alert = [
                'success' => 'Standar Predikat Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'predikat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'nilai_predikat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'nilai_akhir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'predikat' => $this->validation->getError('predikat'),
                        'nilai_predikat' => $this->validation->getError('nilai_predikat'),
                        'nilai_akhir' => $this->validation->getError('nilai_akhir'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $predikat = $this->request->getPost('predikat');
                $nilai_predikat = $this->request->getPost('nilai_predikat');
                $nilai_akhir = $this->request->getPost('nilai_akhir');

                $this->standarPredikatAprModel->update($id, [
                    'predikat' => strtolower($predikat),
                    'nilai_predikat' => strtolower($nilai_predikat),
                    'nilai_akhir' => strtolower($nilai_akhir),

                ]);

                $alert = [
                    'success' => 'Standar Predikat Berhasil di Ubah!'
                ];
            }

            return json_encode($alert);
        }
    }
}
