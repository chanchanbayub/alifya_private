<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Mitra\KelompokBelajarModel;
use App\Models\Mitra\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class InvoiceKonfirmasiController extends BaseController
{
    protected $kelompokModel;
    protected $muridModel;
    protected $kelompokBelajarModel;
    protected $presensiModel;
    protected $pengajarModel;

    protected $validation;

    public function __construct()
    {
        // $this->kelompokModel = new KelompokModel();
        // $this->pengajarModel = new PengajarModel();
        // $this->muridModel = new MuridModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->presensiModel = new PresensiModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'Konfirmasi Jumlah Kehadiran',
        ];

        return view('mitra/invoice_peserta_v', $data);
    }

    public function cek_invoice()
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

                helper(['format']);

                $bulan = $this->request->getVar('bulan');

                $data_bulan = explode("-", $bulan);

                $inputan_bulan = intval($data_bulan[1]);
                $inputan_tahun = intval($data_bulan[0]);

                $peserta_didik = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar(session('mitra_pengajar_id'));

                $data_presensi = [];

                foreach ($peserta_didik as $data_anak) {

                    $presensi_data = $this->presensiModel->getPresensiPerAnak($data_anak->peserta_didik_id, $inputan_bulan, $inputan_tahun);

                    foreach ($presensi_data as $data_peserta) {

                        if ($data_peserta->total_presensi_perbulan == null) {
                            $total_presensi = 0;
                        } else {
                            $total_presensi  = $data_peserta->total_presensi_perbulan;
                        }

                        $data_presensi[] = [
                            'id' => $data_peserta->id,
                            'mitra_pengajar_id' => $data_anak->mitra_pengajar_id,
                            // 'bulan' => $data_peserta->bulan,
                            'nama_lengkap' => $data_anak->nama_lengkap,
                            'nama_lengkap_anak' => $data_anak->nama_lengkap_anak,
                            'total_presensi' => intval($total_presensi),
                        ];
                    }
                }

                $total_data = $this->presensiModel->sumTotalAnak(session('mitra_pengajar_id'), $inputan_bulan, $inputan_tahun);

                if ($total_data->total_presensi_perbulan == null) {
                    $total_presensi_perbulan = intval(0);
                } else {
                    $total_presensi_perbulan = intval($total_data->total_presensi_perbulan);
                }

                $alert = [
                    'data_presensi' => $data_presensi,
                    'total_presensi_perbulan' => $total_presensi_perbulan
                ];
            }
        }
        return json_encode($alert);
    }
}
