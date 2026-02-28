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

                $data_upah_ahl = [];

                foreach ($mitra_pengajar_ahl as $mitra_pengajar) {

                    $upah_ahl = $this->upahMitraModel->getUpahMitraAhlWhereMitraAhl($mitra_pengajar->mitra_id, $inputan_bulan, $inputan_tahun);

                    foreach ($upah_ahl as $upah_ahl) {
                        $data_upah_ahl[] = [
                            'mitra_id' => $upah_ahl->mitra_ahl_id,
                            'nama_lengkap' => $upah_ahl->nama_lengkap,
                            'upah_mitra' => $upah_ahl->upah_mitra,
                            'bonus_kehadiran' => $upah_ahl->bonus_kehadiran,
                            'booster_penugasan' => $upah_ahl->booster_penugasan,
                            'penalangan' => $upah_ahl->penalangan,
                            'lain_lain' => $upah_ahl->lain_lain,
                            'total_akhir' => $upah_ahl->upah_mitra + $upah_ahl->bonus_kehadiran + $upah_ahl->booster_penugasan + $upah_ahl->lain_lain
                        ];
                    }
                }

                // $total_presensi_perbulan = $this->presensiAhlModel->totalPresensiPerbulan($inputan_bulan, $inputan_tahun);
                // $total_presensi_perbulan_masuk = $this->presensiAhlModel->totalPresensiPerbulanMasuk($inputan_bulan, $inputan_tahun);
                // $total_presensi_perbulan_pulang = $this->presensiAhlModel->totalPresensiPerbulanPulang($inputan_bulan, $inputan_tahun);
                // $total_presensi_perbulan_dinas_luar = $this->presensiAhlModel->totalPresensiPerbulanDinasLuar($inputan_bulan, $inputan_tahun);

                $alert = [
                    'upah_ahl' => $data_upah_ahl,
                    // 'total_presensi_perbulan' => $total_presensi_perbulan->total_presensi_perbulan,
                    // 'total_presensi_perbulan_masuk' => $total_presensi_perbulan_masuk->total_presensi_perbulan_masuk,
                    // 'total_presensi_perbulan_pulang' => $total_presensi_perbulan_pulang->total_presensi_perbulan_pulang,
                    // 'total_presensi_perbulan_dinas_luar' => $total_presensi_perbulan_dinas_luar->total_presensi_perbulan_dinas_luar,
                    'bulan' => $inputan_bulan,
                    'tahun' => $inputan_tahun
                ];
            }

            return json_encode($alert);
        }
    }
}
