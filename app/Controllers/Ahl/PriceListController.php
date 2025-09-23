<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\PriceListModel;
use App\Models\Ahl\ProgramAHLModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class PriceListController extends BaseController
{
    protected $programAHLModel;
    protected $priceListModel;
    protected $validation;

    public function __construct()
    {
        $this->programAHLModel = new ProgramAHLModel();
        $this->priceListModel = new PriceListModel();
        $this->validation = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'title' => 'Price List Ahl',
            'program_ahl' => $this->programAHLModel->getProgramAHL()
        ];

        return view('ahl/price_list_ahl_v', $data);
    }

    public function getPriceList()
    {
        if ($this->request->isAjax()) {
            $price_list = $this->priceListModel->getPriceListAhl();

            return DataTable::of($price_list)
                ->add('action', function ($row) {
                    return '<button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' .  $row->id . '" type="button">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    
                    <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>';
                })
                ->setSearchableColumns(['nama_program', 'nama_paket'])
                ->addNumbering('no')->toJson(true);
        }
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'program_belajar_ahl_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],
                'nama_paket' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],
                'jumlah_pertemuan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],
                'harga_paket' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'program_belajar_ahl_id' => $this->validation->getError('program_belajar_ahl_id'),
                        'nama_paket' => $this->validation->getError('nama_paket'),
                        'jumlah_pertemuan' => $this->validation->getError('jumlah_pertemuan'),
                        'harga_paket' => $this->validation->getError('harga_paket'),
                    ]
                ];
            } else {

                $program_belajar_ahl_id = $this->request->getPost('program_belajar_ahl_id');
                $nama_paket = $this->request->getPost('nama_paket');
                $jumlah_pertemuan = $this->request->getPost('jumlah_pertemuan');
                $harga_paket = $this->request->getPost('harga_paket');

                $this->priceListModel->save([
                    'program_belajar_ahl_id' => strtolower($program_belajar_ahl_id),
                    'nama_paket' => strtolower($nama_paket),
                    'jumlah_pertemuan' => strtolower($jumlah_pertemuan),
                    'harga_paket' => strtolower($harga_paket),

                ]);

                $alert = [
                    'success' => 'Price List AHL Berhasil di Simpan!'
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
                'price_list' => $this->priceListModel->where(["id" => $id])->first(),
                'program_ahl' => $this->programAHLModel->getProgramAHL()
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $price_list = $this->priceListModel->where(["id" => $id])->first();

            $this->priceListModel->delete($price_list["id"]);

            $alert = [
                'success' => 'Price List Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'program_belajar_ahl_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],
                'nama_paket' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],
                'jumlah_pertemuan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],
                'harga_paket' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'program_belajar_ahl_id' => $this->validation->getError('program_belajar_ahl_id'),
                        'nama_paket' => $this->validation->getError('nama_paket'),
                        'jumlah_pertemuan' => $this->validation->getError('jumlah_pertemuan'),
                        'harga_paket' => $this->validation->getError('harga_paket'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $program_belajar_ahl_id = $this->request->getPost('program_belajar_ahl_id');
                $nama_paket = $this->request->getPost('nama_paket');
                $jumlah_pertemuan = $this->request->getPost('jumlah_pertemuan');
                $harga_paket = $this->request->getPost('harga_paket');

                $this->priceListModel->update($id, [
                    'program_belajar_ahl_id' => strtolower($program_belajar_ahl_id),
                    'nama_paket' => strtolower($nama_paket),
                    'jumlah_pertemuan' => strtolower($jumlah_pertemuan),
                    'harga_paket' => strtolower($harga_paket),

                ]);

                $alert = [
                    'success' => 'Price List AHL Berhasil di Ubah!'
                ];
            }

            return json_encode($alert);
        }
    }
}
