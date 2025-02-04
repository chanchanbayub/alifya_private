<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KontrakMitraModel;
use App\Models\Admin\PengajarModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class KontrakMitraController extends BaseController
{
    protected $kontrakMitraModel;
    protected $dataPengajarModel;
    protected $validation;

    public function __construct()
    {
        $this->kontrakMitraModel = new KontrakMitraModel();
        $this->dataPengajarModel = new PengajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        helper(['format']);
        $mitra_pengajar = $this->dataPengajarModel->getDataPengajarStatusAktif();
        $kontrak_mitra = $this->kontrakMitraModel->getKontrakMitraData();
        // dd($kontrak_mitra);

        $data = [
            'title' => 'Kontrak Mitra Pengajar',
            'mitra_pengajar' => $mitra_pengajar,
            'kontrak_mitra' => $kontrak_mitra
            // 'jenis_media' => $this->jenisMediaBelajarModel->getJenisMediaBelajar()
        ];

        return view('admin/kontrak_mitra_v', $data);
    }

    public function getKontrakMitra()
    {
        if ($this->request->isAjax()) {
            // $harga_perjam = $this->hargaModel->getHarga();

            $kontrak_mitra = $this->kontrakMitraModel->getKontrakMitra();

            return DataTable::of($kontrak_mitra)

                ->add('action', function ($row) {
                    return '<button class="btn btn-sm btn-outline-warning" id="edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                            <button class="btn btn-sm btn-outline-danger" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' .  $row->id . '" type="button">
                                                    <i class="bi bi-trash"></i>
                                                </button>';
                })
                ->setSearchableColumns(['nama_lengkap_anak', 'bulan', 'harga', 'tahun'])
                ->addNumbering('no')->toJson(true);
        }
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

                'awal_bergabung' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Awal Bergabung Tidak Boleh Kosong !'
                    ]
                ],
                'akhir_kontrak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Akhir Bergabung Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'awal_bergabung' => $this->validation->getError('awal_bergabung'),
                        'akhir_kontrak' => $this->validation->getError('akhir_kontrak'),

                    ]
                ];
            } else {

                // $date = date(01);
                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $akhir_kontrak = $this->request->getPost('akhir_kontrak');
                $awal_bergabung = $this->request->getPost('awal_bergabung');

                $this->kontrakMitraModel->save([
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'awal_bergabung' => $awal_bergabung,
                    'akhir_kontrak' => $akhir_kontrak,

                ]);

                $alert = [
                    'success' => 'Kontrak Mitra Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $harga = $this->hargaModel->where(["id" => $id])->first();
            $peserta_didik = $this->muridModel->getDataMuridAktif();

            $data = [
                'harga' => $harga,
                'peserta_didik' => $peserta_didik,
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $harga = $this->hargaModel->where(["id" => $id])->first();

            $this->hargaModel->delete($harga["id"]);

            $alert = [
                'success' => 'Upah Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Peserta Didik Tidak Boleh Kosong !'
                    ]
                ],

                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Tidak Boleh Kosong !'
                    ]
                ],

                'harga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harga Tidak Boleh Kosong !'
                    ]
                ],


            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'harga' => $this->validation->getError('harga'),
                        'bulan' => $this->validation->getError('bulan'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');

                $peserta_didik_id = $this->request->getPost('peserta_didik_id');

                $bulan = $this->request->getPost('bulan');

                $tahun = $this->request->getPost('tahun');

                $harga = $this->request->getPost('harga');

                if ($tahun == null) {
                    $tahun = date('Y');
                }


                $this->hargaModel->update($id, [
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'harga' => strtolower($harga),

                ]);

                $alert = [
                    'success' => 'Upah Anak Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function update_harga()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'bulan' => $this->validation->getError('bulan'),
                    ]
                ];
            } else {
                $bulan = $this->request->getPost('bulan');
                $tahun = date('Y');

                $peserta_didik = $this->muridModel->getDataMuridAktif();
                // dd($peserta_didik);

                foreach ($peserta_didik as $peserta) {
                    $data_harga = $this->hargaModel->where(["peserta_didik_id" => $peserta->id])->orderBy('id')->get()->getRowObject();
                    if ($data_harga != null) {
                        if ($data_harga->peserta_didik_id != null) {
                            if ($bulan != $data_harga->bulan) {
                                $this->hargaModel->save([
                                    'peserta_didik_id' => strtolower($data_harga->peserta_didik_id),
                                    'harga' => strtolower($data_harga->harga),
                                    'bulan' => $bulan,
                                    'tahun' => $tahun
                                ]);
                            }
                        }
                        $alert = [
                            'success' => 'Upah Anak Berhasil di Simpan !'
                        ];
                    }
                }
            }

            return json_encode($alert);
        }
    }

    public function harga_perbulan()
    {
        if ($this->request->isAJAX()) {

            $bulan = $this->request->getVar('bulan');

            $data_bulan = explode("-", $bulan);

            $inputan_bulan = $data_bulan[1];
            $inputan_tahun = $data_bulan[0];

            $harga = $this->hargaModel->getHargaPerbulanData($inputan_bulan, $inputan_tahun);


            $data = [
                'harga' => $harga,
            ];

            return json_encode($data);
        }
    }
}
