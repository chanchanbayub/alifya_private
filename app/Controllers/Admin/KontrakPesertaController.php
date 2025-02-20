<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KontrakPesertaModel;
use App\Models\Admin\MuridModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontrakPesertaController extends BaseController
{
    protected $kontrakPesertaModel;
    protected $dataMuridModel;
    protected $validation;

    public function __construct()
    {
        $this->kontrakPesertaModel = new KontrakPesertaModel();
        $this->dataMuridModel = new MuridModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        helper(['format']);

        $kontrak_peserta = $this->kontrakPesertaModel->getKontrakPesertaDidik();
        // dd($kontrak_peserta);

        $hari_ini = date('Y-m-d');

        $tanggal_hari_ini = date_create($hari_ini);

        $data_kontrak_peserta = [];

        foreach ($kontrak_peserta as $kontrak_peserta) {
            $awal_bergabung_data = date_create($kontrak_peserta->bulan_masuk);
            $masa_kerja = date_diff($tanggal_hari_ini, $awal_bergabung_data);


            $data_kontrak_peserta[] = [
                'id' => $kontrak_peserta->id,
                'nama_lengkap_anak' => $kontrak_peserta->nama_lengkap_anak,

                'awal_bergabung' => $awal_bergabung_data->format('Y-m'),
                'tahun_bergabung' => $awal_bergabung_data->format('Y'),

                'masa_kerja' => $masa_kerja->format('%y Tahun %m Bulan'),

                'status_murid_id' => $kontrak_peserta->status_murid_id,
                'status_murid' => $kontrak_peserta->status_murid
                // 'masa_berlaku_kontrak' => $masa_berlaku_kontrak->format('%y Tahun %m Bulan'),
            ];
        }

        // dd($data_kontrak_peserta);

        $data = [
            'title' => 'Kontrak Peserta Didik',
            'kontrak_peserta' => $data_kontrak_peserta,
            'peserta_didik' => $this->dataMuridModel->getDataMuridAktif(),
            // 'data_kontrak_mitra' => $data_kontrak_mitra
        ];

        return view('admin/kontrak_peserta_v', $data);
    }


    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'peserta_didik_id' => [
                    'rules' => 'required|is_unique[kontrak_peserta_table.peserta_didik_id]',
                    'errors' => [
                        'required' => 'Peserta Didik Tidak Boleh Kosong!',
                        'is_unique' => 'Peserta Didik Telah Terdaftar'
                    ]
                ],

                'bulan_masuk' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Awal Bergabung Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'bulan_masuk' => $this->validation->getError('bulan_masuk'),

                    ]
                ];
            } else {


                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $bulan_masuk = $this->request->getPost('bulan_masuk');

                $this->kontrakPesertaModel->save([
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'bulan_masuk' => $bulan_masuk,

                ]);

                $alert = [
                    'success' => 'Kontrak Peserta Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kontrak_peserta = $this->kontrakPesertaModel->where(["id" => $id])->first();

            $peserta_didik = $this->dataMuridModel->getDataMuridAktif();

            $data = [
                'kontrak_peserta' => $kontrak_peserta,
                'peserta_didik' => $peserta_didik,
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kontrak_peserta = $this->kontrakPesertaModel->where(["id" => $id])->first();

            $this->kontrakPesertaModel->delete($kontrak_peserta["id"]);

            $alert = [
                'success' => 'Kontrak Peserta Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'peserta_didik_id' => [
                    'rules' => 'required|is_unique[kontrak_peserta_table.peserta_didik_id]',
                    'errors' => [
                        'required' => 'Peserta Didik Tidak Boleh Kosong!',
                        'is_unique' => 'Peserta Didik Telah Terdaftar'
                    ]
                ],

                'bulan_masuk' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Awal Bergabung Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'bulan_masuk' => $this->validation->getError('bulan_masuk'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');

                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $bulan_masuk = $this->request->getPost('bulan_masuk');

                $this->kontrakPesertaModel->update($id, [
                    'peserta_didik_id' => strtolower($peserta_didik_id),
                    'bulan_masuk' => $bulan_masuk,
                ]);

                $alert = [
                    'success' => 'Kontrak Peserta Berhasil di Ubah!'
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

            $kontrak_mitra = $this->kontrakMitraModel->getKontrakMitraPerbulan($inputan_bulan, $inputan_tahun);

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
