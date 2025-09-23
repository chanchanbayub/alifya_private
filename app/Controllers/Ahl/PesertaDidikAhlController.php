<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\PesertaDidikAhlModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class PesertaDidikAhlController extends BaseController
{
    protected $pesertaDidikAhlModel;
    protected $validation;

    public function __construct()
    {
        $this->pesertaDidikAhlModel = new PesertaDidikAhlModel();
        $this->validation = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'title' => 'Peserta Didik AHL',

        ];

        return view('ahl/peserta_ahl_v', $data);
    }


    public function getPesertaAhl()
    {
        if ($this->request->isAjax()) {
            $peserta_didik_ahl = $this->pesertaDidikAhlModel->getPesertaAhl();

            return DataTable::of($peserta_didik_ahl)
                ->add('action', function ($row) {
                    return '<button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>';

                    // <button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' .  $row->id . '" type="button">
                    //     <i class="bi bi-pencil-square"></i>
                    // </button>
                })
                ->add('lihat_profil', function ($row) {
                    return '<a href="/admin/peserta_ahl/getProfil/' .  $row->id . '"" class="btn btn-sm btn-outline-primary" target="_blank" >
                                                    <i class="bi bi-eye"></i> Lihat Profil
                                                </a>
                           ';
                })
                ->setSearchableColumns(['nama_lengkap_anak', 'id', 'status_murid'])
                ->addNumbering('no')->toJson(true);
        }
    }


    public function getProfil($id)
    {
        if ($id == null) {
            dd($id);
            return redirect()->to('/admin/data_murid');
        }

        $profil = $this->pesertaDidikAhlModel->getProfil($id);
        // dd($profil);
        $hari_ini = date_create();
        $tanggal_lahir = date_create($profil->tanggal_lahir_anak);

        $usia = date_diff($hari_ini, $tanggal_lahir);

        if ($profil == null) {
            return redirect()->to('/admin/data_murid');
        }

        $data = [
            'title' => 'Profil Peserta Didik AHL',
            'profil' => $profil,
            'usia' => $usia
        ];

        return view('ahl/profil_ahl_v', $data);
    }


    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'lokasi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'lokasi' => $this->validation->getError('lokasi'),

                    ]
                ];
            } else {

                $lokasi = $this->request->getPost('lokasi');

                $this->pesertaDidikAhlModel->save([
                    'lokasi' => strtolower($lokasi),

                ]);

                $alert = [
                    'success' => 'Lokasi Presensi Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $data = [
                'peserta_ahl' => $this->pesertaDidikAhlModel->where(["id" => $id])->first()
            ];


            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {


            $id = $this->request->getVar('id');

            $peserta_didik_ahl = $this->pesertaDidikAhlModel->where(["id" => $id])->first();

            $path_foto = 'foto_profil_anak_ahl/' . $peserta_didik_ahl['foto_anak'];
            $path_bukti_tf = 'bukti_tf/' . $peserta_didik_ahl['bukti_tf'];

            $this->pesertaDidikAhlModel->delete($peserta_didik_ahl["id"]);

            $alert = [
                'success' => 'Peserta AHL Berhasil di Hapus!'
            ];

            if ($peserta_didik_ahl['foto_anak'] != null) {
                if (file_exists($path_foto)) {
                    unlink($path_foto);
                }
            }

            if ($peserta_didik_ahl['bukti_tf'] != null) {
                if (file_exists($path_bukti_tf)) {
                    unlink($path_bukti_tf);
                }
            }

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'lokasi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'lokasi Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'lokasi' => $this->validation->getError('lokasi'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $lokasi = $this->request->getPost('lokasi');

                $this->pesertaDidikAhlModel->update($id, [
                    'lokasi' => strtolower($lokasi),

                ]);

                $alert = [
                    'success' => 'Lokasi Presensi Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
