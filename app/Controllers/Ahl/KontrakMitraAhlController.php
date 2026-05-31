<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Admin\PengajarModel;
use App\Models\Ahl\KontrakMitraAhlModel;
use App\Models\Ahl\MitraPengajarAhlModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontrakMitraAhlController extends BaseController
{
    protected $kontrakMitraAhlModel;
    protected $dataPengajarModel;
    protected $mitraPengajarAhlModel;
    protected $validation;

    public function __construct()
    {
        $this->kontrakMitraAhlModel = new KontrakMitraAhlModel();
        $this->dataPengajarModel = new PengajarModel();
        $this->validation = \Config\Services::validation();
        $this->mitraPengajarAhlModel = new MitraPengajarAhlModel();
    }

    public function index()
    {
        helper(['format']);

        $kontrak_mitra_ahl = $this->kontrakMitraAhlModel->getKontrakMitraData();
        // dd($kontrak_mitra_ahl);
        // dd($kontrak_mitra_ahl);
        $hari_ini = date('Y-m-d');

        $tanggal_hari_ini = date_create($hari_ini);

        $data_kontrak_mitra = [];

        foreach ($kontrak_mitra_ahl as $kontrak_mitra) {
            // dd($kontrak_mitra->id, $kontrak_mitra->nama_lengkap, $kontrak_mitra->mitra_pengajar_id);
            $awal_bergabung_data = date_create($kontrak_mitra->awal_bergabung);
            $akhir_kontrak_data = date_create($kontrak_mitra->akhir_kontrak);
            // dd($akhir_kontrak_data);
            $masa_kerja = date_diff($tanggal_hari_ini, $awal_bergabung_data);

            $masa_berlaku_kontrak = date_diff($tanggal_hari_ini, $akhir_kontrak_data);

            $data_kontrak_mitra[] = [
                'id' => $kontrak_mitra->id,
                'mitra_pengajar_id' => $kontrak_mitra->mitra_pengajar_id,
                'nama_lengkap' => $kontrak_mitra->nama_lengkap,

                'awal_bergabung' => $awal_bergabung_data->format('Y-m'),
                'tahun_bergabung' => $awal_bergabung_data->format('Y'),

                'akhir_kontrak' => $akhir_kontrak_data->format('Y-m'),
                'tahun_akhir_kontrak' => $akhir_kontrak_data->format('Y'),

                'masa_kerja' => $masa_kerja->format('%y Tahun %m Bulan'),
                'masa_berlaku_kontrak' => $masa_berlaku_kontrak->format('%y Tahun %m Bulan'),
            ];
        }

        // dd($data_kontrak_mitra);

        $data = [
            'title' => 'Kontrak Mitra Pengajar Alifya Home Learning',
            'mitra_pengajar' => $this->mitraPengajarAhlModel->getMitraPengajarAhl(),
            'data_kontrak_mitra' => $data_kontrak_mitra
        ];

        return view('ahl/kontrak_mitra_ahl_v', $data);
    }


    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_pengajar_id' => [
                    'rules' => 'required|is_unique[kontrak_mitra_ahl_table.mitra_pengajar_id]',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !',
                        'is_unique' => 'Mitra Sudah terdaftar di database !'
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

                $this->kontrakMitraAhlModel->save([
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'awal_bergabung' => $awal_bergabung,
                    'akhir_kontrak' => $akhir_kontrak,

                ]);

                $alert = [
                    'success' => 'Kontrak Mitra AHL Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kontrak_mitra = $this->kontrakMitraAhlModel->where(["id" => $id])->first();

            $mitra_pengajar = $this->mitraPengajarAhlModel->getMitraPengajarAhl();

            $data = [
                'kontrak_mitra' => $kontrak_mitra,
                'mitra_pengajar' => $mitra_pengajar,
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kontrak_mitra = $this->kontrakMitraAhlModel->where(["id" => $id])->first();

            $this->kontrakMitraAhlModel->delete($kontrak_mitra["id"]);

            $alert = [
                'success' => 'Kontrak Mitra AHL Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !'
                    ]
                ],
                'awal_bergabung' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Awal bergabung Tidak Boleh Kosong !'
                    ]
                ],
                'akhir_kontrak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'akhir_kontrak Tidak Boleh Kosong !'
                    ]
                ],


            ])) {
                $alert = [
                    'error' => [
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'akhir_kontrak' => $this->validation->getError('akhir_kontrak'),
                        'awal_bergabung' => $this->validation->getError('awal_bergabung'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');

                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');

                $awal_bergabung = $this->request->getPost('awal_bergabung');

                $akhir_kontrak = $this->request->getPost('akhir_kontrak');

                $this->kontrakMitraAhlModel->update($id, [
                    'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                    'awal_bergabung' => $awal_bergabung,
                    'akhir_kontrak' => strtolower($akhir_kontrak),

                ]);

                $alert = [
                    'success' => 'Kontrak Mitra AHL Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }


    public function kontrak_perbulan()
    {
        if ($this->request->isAJAX()) {

            $bulan = $this->request->getVar('bulan');

            $data_bulan = explode("-", $bulan);

            $inputan_bulan = $data_bulan[1];
            $inputan_tahun = $data_bulan[0];

            $kontrak_mitra = $this->kontrakMitraAhlModel->getKontrakMitraPerbulan($inputan_bulan, $inputan_tahun);

            $hari_ini = date('Y-m-d');

            $tanggal_hari_ini = date_create($hari_ini);

            $data_kontrak_mitra = [];

            foreach ($kontrak_mitra as $kontrak_mitra) {

                $awal_bergabung_data = date_create($kontrak_mitra->awal_bergabung);
                $akhir_kontrak_data = date_create($kontrak_mitra->akhir_kontrak);
                $masa_kerja = date_diff($tanggal_hari_ini, $awal_bergabung_data);

                $masa_berlaku_kontrak = date_diff($tanggal_hari_ini, $akhir_kontrak_data);

                $data_kontrak_mitra[] = [
                    'id' => $kontrak_mitra->id,
                    'nama_lengkap' => $kontrak_mitra->nama_lengkap,

                    'awal_bergabung' => $awal_bergabung_data->format('Y-m'),
                    'tahun_bergabung' => $awal_bergabung_data->format('Y'),

                    'akhir_kontrak' => $akhir_kontrak_data->format('Y-m'),
                    'tahun_akhir_kontrak' => $akhir_kontrak_data->format('Y'),

                    'masa_kerja' => $masa_kerja->format('%y Tahun %m Bulan'),
                    'masa_berlaku_kontrak' => $masa_berlaku_kontrak->format('%y Tahun %m Bulan'),
                ];
            }

            $data = [
                'kontrak_mitra_data' => $data_kontrak_mitra,
            ];

            return json_encode($data);
        }
    }
}
