<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KategoriAPRModel;
use App\Models\Admin\SkalaNilaiAPRModel;
use CodeIgniter\HTTP\ResponseInterface;

class SkalaNilaiAPRController extends BaseController
{
    protected $skalaNilaiModel;
    protected $kategoriAPRModel;
    protected $validation;

    public function __construct()
    {
        $this->skalaNilaiModel = new SkalaNilaiAPRModel();
        $this->kategoriAPRModel = new KategoriAPRModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Skala Nilai Alifya Performance Rangking',
            'skala_nilai' => $this->skalaNilaiModel->getSkalaNilai(),
            'kategori_apr' => $this->kategoriAPRModel->getKategori()
        ];

        return view('admin/skala_nilai_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'kategori_apr_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'nilai' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'kategori_apr_id' => $this->validation->getError('kategori_apr_id'),
                        'bobot' => $this->validation->getError('bobot'),
                        'nilai' => $this->validation->getError('nilai'),
                        'keterangan' => $this->validation->getError('keterangan'),

                    ]
                ];
            } else {

                $kategori_apr_id = $this->request->getPost('kategori_apr_id');
                $bobot = $this->request->getPost('bobot');
                $nilai = $this->request->getPost('nilai');
                $keterangan = $this->request->getPost('keterangan');

                $this->skalaNilaiModel->save([
                    'kategori_apr_id' => strtolower($kategori_apr_id),
                    'bobot' => strtolower($bobot),
                    'nilai' => strtolower($nilai),
                    'keterangan' => strtolower($keterangan),

                ]);

                $alert = [
                    'success' => 'Skala Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $skala_nilai = $this->skalaNilaiModel->where(["id" => $id])->first();
            $kategori_apr = $this->kategoriAPRModel->getKategori();

            $data = [
                'skala_nilai' => $skala_nilai,
                'kategori_apr' => $kategori_apr
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $skala_nilai = $this->skalaNilaiModel->where(["id" => $id])->first();

            $this->skalaNilaiModel->delete($skala_nilai["id"]);

            $alert = [
                'success' => 'Skala Nilai Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'kategori_apr_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'nilai' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'kategori_apr_id' => $this->validation->getError('kategori_apr_id'),
                        'bobot' => $this->validation->getError('bobot'),
                        'nilai' => $this->validation->getError('nilai'),
                        'keterangan' => $this->validation->getError('keterangan'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $kategori_apr_id = $this->request->getPost('kategori_apr_id');
                $bobot = $this->request->getPost('bobot');
                $nilai = $this->request->getPost('nilai');
                $keterangan = $this->request->getPost('keterangan');

                $this->skalaNilaiModel->update($id, [
                    'kategori_apr_id' => strtolower($kategori_apr_id),
                    'bobot' => strtolower($bobot),
                    'nilai' => strtolower($nilai),
                    'keterangan' => strtolower($keterangan),

                ]);

                $alert = [
                    'success' => 'Skala Berhasil di Ubah!'
                ];
            }

            return json_encode($alert);
        }
    }
}
