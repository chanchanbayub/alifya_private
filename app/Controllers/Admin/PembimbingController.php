<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PembimbingModel;
use App\Models\Admin\PengajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class PembimbingController extends BaseController
{
    protected $pembimbingModel;
    protected $pengajarModel;
    protected $validation;

    public function __construct()
    {
        $this->pembimbingModel = new PembimbingModel();
        $this->pengajarModel = new PengajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Sistem Pembimbing',
            'pembimbing' => $this->pembimbingModel->getPembimbing(),
            'pengajar' => $this->pengajarModel->getDataPengajarStatusAktif()
        ];

        return view('admin/pembimbing_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_pengajar_id' => [
                    'rules' => 'required|is_unique[pembimbing_table.mitra_pengajar_id]',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !',
                        'is_unique' => 'Pembimbing Sudah Terdaftar'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),

                    ]
                ];
            } else {

                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');

                $this->pembimbingModel->save([
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),

                ]);

                $alert = [
                    'success' => 'Pembimbing Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $pembimbing = $this->pembimbingModel->where(["id" => $id])->first();
            $pengajar = $this->pengajarModel->getDataPengajarStatusAktif();

            $data = [
                'pembimbing' => $pembimbing,
                'pengajar' => $pengajar
            ];


            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $pembimbing = $this->pembimbingModel->where(["id" => $id])->first();

            $this->pembimbingModel->delete($pembimbing["id"]);

            $alert = [
                'success' => 'Pembimbing Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_pengajar_id' => [
                    'rules' => 'required|is_unique[pembimbing_table.mitra_pengajar_id]',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !',
                        'is_unique' => 'Pembimbing Sudah Terdaftar'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),

                    ]
                ];
            } else {

                $id = $this->request->getVar('id');
                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');

                $this->pembimbingModel->update($id, [
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),

                ]);

                $alert = [
                    'success' => 'Pembimbing Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
