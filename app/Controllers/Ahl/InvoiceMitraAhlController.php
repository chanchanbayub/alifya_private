<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Admin\PengajarModel;
use App\Models\Ahl\JamMasukAhlModel;
use App\Models\Ahl\MitraPengajarAhlModel;
use App\Models\Ahl\PresensiAhlModel;
use App\Models\Ahl\UpahMitraModel;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;

class InvoiceMitraAhlController extends BaseController
{
    protected $mitraPengajarAhlModel;
    protected $upahMitraModel;
    protected $pengajarModel;
    protected $presensiAhlModel;
    protected $jamMasukAhlModel;
    protected $validation;

    public function __construct()
    {
        $this->mitraPengajarAhlModel = new MitraPengajarAhlModel();
        $this->upahMitraModel = new UpahMitraModel();
        $this->jamMasukAhlModel = new JamMasukAhlModel();
        $this->presensiAhlModel = new PresensiAhlModel();
        $this->pengajarModel = new PengajarModel();
        $this->validation = \Config\Services::validation();

        helper(['format']);
    }


    public function index()
    {
        $data = [
            'title' => 'Invoice Mitra Pengajar AHL',
            'presensi_ahl' => $this->presensiAhlModel->getPresensiAhl(),
            'mitra_pengajar_ahl' => $this->mitraPengajarAhlModel->getMitraPengajarAhl(),
        ];

        return view('ahl/invoice_mitra_ahl_v', $data);
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
                // dd($inputan_bulan);
                $inputan_tahun = intval($data_bulan[0]);

                $mitra_pengajar_ahl = $this->mitraPengajarAhlModel->getMitraPengajarAhl();

                $data_presensi_ahl = [];

                foreach ($mitra_pengajar_ahl as $mitra_pengajar) {

                    $presensi = $this->presensiAhlModel->getPresensiWithMonthInvoice($mitra_pengajar->mitra_id, $inputan_bulan, $inputan_tahun);
                    $presensi_masuk = $this->presensiAhlModel->getPresensiMasuk($mitra_pengajar->mitra_id, $inputan_bulan, $inputan_tahun);
                    $presensi_pulang = $this->presensiAhlModel->getPresensiPulang($mitra_pengajar->mitra_id, $inputan_bulan, $inputan_tahun);
                    $presensi_dinas_luar = $this->presensiAhlModel->getPresensiDinasLuar($mitra_pengajar->mitra_id, $inputan_bulan, $inputan_tahun);




                    foreach ($presensi as $presensi) {
                        $data_presensi_ahl[] = [
                            'nama_lengkap' => $presensi->nama_lengkap,
                            'jumlah_presensi_masuk' => $presensi_masuk->jumlah_presensi_masuk,
                            'jumlah_presensi_pulang' => $presensi_pulang->jumlah_presensi_pulang,
                            'jumlah_presensi_dinas_luar' => $presensi_dinas_luar->jumlah_presensi_dinas_luar,
                            'jumlah_presensi_perbulan' => $presensi->jumlah_presensi_perbulan,
                            'upah_mitra' => $presensi->upah_mitra,
                            'lain_lain' => $presensi->lain_lain,
                            'total_akhir' => $presensi->upah_mitra + $presensi->lain_lain
                        ];
                    }
                }

                $total_presensi_perbulan = $this->presensiAhlModel->totalPresensiPerbulan($inputan_bulan, $inputan_tahun);
                $total_presensi_perbulan_masuk = $this->presensiAhlModel->totalPresensiPerbulanMasuk($inputan_bulan, $inputan_tahun);
                $total_presensi_perbulan_pulang = $this->presensiAhlModel->totalPresensiPerbulanPulang($inputan_bulan, $inputan_tahun);
                $total_presensi_perbulan_dinas_luar = $this->presensiAhlModel->totalPresensiPerbulanDinasLuar($inputan_bulan, $inputan_tahun);

                $alert = [
                    'data_presensi' => $data_presensi_ahl,
                    'total_presensi_perbulan' => $total_presensi_perbulan->total_presensi_perbulan,
                    'total_presensi_perbulan_masuk' => $total_presensi_perbulan_masuk->total_presensi_perbulan_masuk,
                    'total_presensi_perbulan_pulang' => $total_presensi_perbulan_pulang->total_presensi_perbulan_pulang,
                    'total_presensi_perbulan_dinas_luar' => $total_presensi_perbulan_dinas_luar->total_presensi_perbulan_dinas_luar

                ];
            }

            return json_encode($alert);
        }
    }
}
