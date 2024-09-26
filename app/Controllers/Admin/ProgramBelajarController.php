<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ProgramBelajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProgramBelajarController extends BaseController
{
    protected $programBelajarModel;
    protected $validation;

    public function __construct()
    {
        $this->programBelajarModel = new ProgramBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Program Belajar',
            'program_belajar' => $this->programBelajarModel->getProgramBelajar()
        ];

        return view('admin/program_belajar_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'nama_program' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Program Tidak Boleh Kosong !'
                    ]
                ],
                'usia_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Usia Anak Tidak Boleh Kosong!'
                    ]
                ],
                'banner' => [
                    'rules' => 'uploaded[banner]|max_size[banner,2048]|is_image[banner]|mime_in[banner,image/png,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'Banner Tidak Boleh Kosong !',
                        'max_size' => 'Ukuran Terlalu Besar (max : 2MB) !',
                        'is_image' => 'Yang Anda Upload Bukan Gambar !',
                        'mime_in' => 'Format yang diperbolehkan hanya, png, jpg, jpeg !',
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'nama_program' => $this->validation->getError('nama_program'),
                        'usia_anak' => $this->validation->getError('usia_anak'),
                        'banner' => $this->validation->getError('banner'),
                    ]
                ];
            } else {

                $nama_program = $this->request->getPost('nama_program');
                $usia_anak = $this->request->getPost('usia_anak');
                $banner = $this->request->getFile('banner');

                $nama_foto = $banner->getRandomName();

                $this->programBelajarModel->save([
                    'nama_program' => strtolower($nama_program),
                    'usia_anak' => strtolower($usia_anak),
                    'banner' => strtolower($nama_foto),
                ]);

                $banner->move('banner', $nama_foto);

                $alert = [
                    'success' => 'Program Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $program = $this->programBelajarModel->where(["id" => $id])->first();

            return json_encode($program);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $program = $this->programBelajarModel->where(["id" => $id])->first();

            $path_banner = 'banner/' . $program['banner'];

            $this->programBelajarModel->delete($program["id"]);

            $alert = [
                'success' => 'Program Belajar Berhasil di Hapus !'
            ];

            if ($program['banner'] != null) {
                if (file_exists($path_banner)) {
                    unlink($path_banner);
                }
            }

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
                        'required' => 'Nama Program Tidak Boleh Kosong !'
                    ]
                ],
                'usia_anak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jumlah Pertemuan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'nama_program' => $this->validation->getError('nama_program'),
                        'usia_anak' => $this->validation->getError('usia_anak'),
                        'banner' => $this->validation->getError('banner'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $banner_lama = $this->request->getPost('banner_lama');
                $nama_program = $this->request->getPost('nama_program');
                $usia_anak = $this->request->getPost('usia_anak');

                $path_lama = 'banner/' . $banner_lama;

                $banner = $this->request->getFile('banner');

                if ($banner->getError() == 4) {
                    $nama_foto = $banner_lama;
                } else {
                    if (file_exists($path_lama)) {
                        unlink($path_lama);
                    }
                    $nama_foto = $banner->getRandomName();
                    $banner->move('banner', $nama_foto);
                }

                $this->programBelajarModel->update($id, [
                    'nama_program' => strtolower($nama_program),
                    'usia_anak' => strtolower($usia_anak),
                    'banner' => strtolower($nama_foto),

                ]);

                $alert = [
                    'success' => 'Program Belajar Berhasil diUbah!'
                ];
            }

            return json_encode($alert);
        }
    }
}
