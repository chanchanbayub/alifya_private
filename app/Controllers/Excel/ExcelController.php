<?php

namespace App\Controllers\Excel;

use App\Controllers\BaseController;
use App\Models\Admin\HargaMitraModel;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KelompokModel;
use App\Models\Admin\KlaimLainLainMitraModel;
use App\Models\Admin\KlaimMediaPesertaModel;
use App\Models\Admin\PresensiModel;
use App\Models\Ahl\MitraPengajarAhlModel;
use App\Models\Ahl\UpahMitraModel;
use CodeIgniter\HTTP\ResponseInterface;

class ExcelController extends BaseController
{
    protected $presensiModel;
    protected $kelompokBelajarModel;
    protected $klaimMediaPesertaModel;
    protected $klaimLainLainModel;
    protected $kelompokModel;
    protected $validation;
    protected $hargaMitraModel;
    protected $mitraPengajarAhlModel;
    protected $upahMitraModel;

    public function __construct()
    {
        $this->presensiModel = new PresensiModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->klaimMediaPesertaModel = new KlaimMediaPesertaModel();
        $this->hargaMitraModel = new HargaMitraModel();
        $this->klaimLainLainModel = new KlaimLainLainMitraModel();
        $this->kelompokModel = new KelompokModel();
        $this->validation = \Config\Services::validation();
        $this->mitraPengajarAhlModel = new MitraPengajarAhlModel();
        $this->upahMitraModel = new UpahMitraModel();
    }

    public function invoice_mitra()
    {
        helper(['format']);

        $bulan = $this->request->getVar('bulan');

        $data_bulan = explode("-", $bulan);

        $inputan_bulan = intval($data_bulan[1]);
        $inputan_tahun = intval($data_bulan[0]);

        $pengajar_data = $this->kelompokModel->getKelompokPengajar();

        $data_presensi = [];

        foreach ($pengajar_data as $mitra_pengajar) {

            $presensi_data = $this->presensiModel->getInvoiceMitraData($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

            $harga_mitra = $this->presensiModel->getInvoiceMitraWithMonthSum($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

            $harga_media = $this->hargaMitraModel->getHargaMitraPerbulan($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

            // $booster_media = $this->presensiModel->getMediaMitraWithMonthSum($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

            $lain_lain = $this->klaimLainLainModel->getLainLainPerbulanDataMitraPengajar($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

            $media_belajar_anak = $this->klaimMediaPesertaModel->SumHargaMediaWithMitra($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

            foreach ($presensi_data as $data_peserta) {

                if ($data_peserta->total_presensi == null) {
                    $total_presensi = 0;
                } else {
                    $total_presensi = $data_peserta->total_presensi;
                }

                if ($harga_mitra->total == null) {
                    $harga_mitra = 0;
                } else {
                    $harga_mitra = $harga_mitra->total;
                }

                if ($media_belajar_anak->total_harga_media == null) {
                    $total_media_anak = 0;
                } else {
                    $total_media_anak  = $media_belajar_anak->total_harga_media;
                }

                if ($lain_lain->total_lain_lain == null) {
                    $total_lain_lain = 0;
                } else {
                    $total_lain_lain  = $lain_lain->total_lain_lain;
                }

                if ($lain_lain->total_booster == null) {
                    $total_booster = 0;
                } else {
                    $total_booster  = $lain_lain->total_booster;
                }

                $data_presensi[] = [
                    'data_pengajar_id' => $mitra_pengajar->mitra_pengajar_id,
                    'bulan' => $inputan_bulan,
                    'tahun' => $inputan_tahun,
                    'mitra_pengajar_id' => $mitra_pengajar->mitra_pengajar_id,
                    'jumlah_anak' => $data_peserta->jumlah_anak,
                    'nama_lengkap' => $mitra_pengajar->nama_lengkap,
                    'total_presensi' => intval($total_presensi),
                    'harga_mitra' => intval($harga_mitra),
                    'booster_mitra' => intval($total_booster),
                    'total_jumlah_booster' => intval($data_peserta->jumlah_anak) * intval($total_booster),
                    'total_lain_lain' => intval($total_lain_lain),
                    'total_akhir' => intval($harga_mitra) +  intval($total_lain_lain) + intval($data_peserta->jumlah_anak) * intval($total_booster)
                ];
            }
        }

        $total_data = $this->presensiModel->sumTotalAnak($inputan_bulan, $inputan_tahun);

        $total_harga_mitra = $this->presensiModel->SumHargaPresensiMitra($inputan_bulan, $inputan_tahun);


        $total_lain_lain_mitra = $this->klaimLainLainModel->SumLainLainPerbulan($inputan_bulan, $inputan_tahun);

        $total_booster_media = 0;
        foreach ($data_presensi as $jumlah => $value) {
            $total_booster_media += intval($value["total_jumlah_booster"]);
        }

        // data anak
        if ($total_data->total_anak == null) {
            $total_anak = intval(0);
        } else {
            $total_anak =  intval($total_data->total_anak);
        }

        // data Presensi perbulan
        if ($total_data->total_presensi_perbulan == null) {
            $total_presensi_perbulan = intval(0);
        } else {
            $total_presensi_perbulan = intval($total_data->total_presensi_perbulan);
        }

        // harga_mitra
        if ($total_harga_mitra->total_harga_mitra == null) {
            $total_harga = intval(0);
        } else {
            $total_harga = intval($total_harga_mitra->total_harga_mitra);
        }

        // lain_lain
        if ($total_lain_lain_mitra->total_lain_lain == null) {
            $total_lain_lain = intval(0);
        } else {
            $total_lain_lain = intval($total_lain_lain_mitra->total_lain_lain);
        }

        $total_pemasukan = $total_harga  + $total_lain_lain + $total_booster_media;


        // dd($data_presensi);



        $data = [
            'data_presensi' => $data_presensi,
            'total_anak_aktif' => $total_anak,
            'total_presensi_perbulan' => $total_presensi_perbulan,
            'total_pemasukan' => $total_pemasukan,
            // 'harga_mitra' => $harga_mitra,
            'bulan_indo' => $inputan_bulan
        ];

        return view('excel/export_excel', $data);
    }

    public function invoice_peserta()
    {

        helper(['format']);

        $bulan = $this->request->getVar('bulan');

        $data_bulan = explode("-", $bulan);

        $inputan_bulan = intval($data_bulan[1]);
        $inputan_tahun = intval($data_bulan[0]);

        $peserta_didik = $this->kelompokBelajarModel->getKelompokBelajar();

        $data_presensi = [];
        foreach ($peserta_didik as $data_anak) {

            $presensi_data = $this->presensiModel->getInvoicePerAnak($data_anak->peserta_didik_id, $inputan_bulan, $inputan_tahun);

            // dd($presensi_data);

            foreach ($presensi_data as $data_peserta) {


                if ($data_peserta->harga == null) {
                    $harga = 0;
                } else {
                    $harga = $data_peserta->harga;
                }

                if ($data_peserta->harga_media == null) {
                    $harga_media = 0;
                } else {
                    $harga_media  = $data_peserta->harga_media;
                }

                if ($data_peserta->lain_lain == null) {
                    $lain_lain = 0;
                } else {
                    $lain_lain  = $data_peserta->lain_lain;
                }

                if ($data_peserta->total_presensi == null) {
                    $total_presensi = 0;
                } else {
                    $total_presensi  = $data_peserta->total_presensi;
                }

                $data_presensi[] = [
                    'id' => $data_peserta->id,
                    'mitra_pengajar_id' => $data_anak->mitra_pengajar_id,
                    'bulan' => $data_peserta->bulan,
                    'nama_lengkap' => $data_anak->nama_lengkap,
                    'nama_lengkap_anak' => $data_anak->nama_lengkap_anak,
                    'total_presensi' => intval($total_presensi),
                    'harga' =>  intval($harga),
                    'jumlah_upah' => intval($harga) * intval($total_presensi),
                    'media_belajar' => intval($harga_media),
                    'lain_lain' => intval($lain_lain),
                    'total_akhir' => intval($total_presensi) * intval($harga) + intval($harga_media) + intval($lain_lain)
                ];
            }
        }



        $total_data = $this->presensiModel->sumTotalAnak($inputan_bulan, $inputan_tahun);

        $total_harga = $this->presensiModel->SumHargaPresensi($inputan_bulan, $inputan_tahun);

        $total_harga_media = $this->klaimMediaPesertaModel->SumHargaMedia($inputan_bulan, $inputan_tahun);

        // data anak
        if ($total_data->total_anak == null) {
            $total_anak = intval(0);
        } else {
            $total_anak =  intval($total_data->total_anak);
        }

        if ($total_harga->total_harga == null) {
            $total_bayar = "0";
        } else {
            $total_bayar = $total_harga->total_harga;
        }

        if ($total_harga_media->total_harga_media == null) {
            $total_media = "0";
        } else {
            $total_media = $total_harga_media->total_harga_media;
        }

        if ($total_harga_media->total_lain_lain == null) {
            $total_lain_lain = "0";
        } else {
            $total_lain_lain = $total_harga_media->total_lain_lain;
        }

        if ($total_data->total_presensi_perbulan == null) {
            $total_presensi_perbulan = intval(0);
        } else {
            $total_presensi_perbulan = intval($total_data->total_presensi_perbulan);
        }

        $total_pemasukan = intval($total_bayar) + intval($total_media) + intval($total_lain_lain);


        $data = [
            'data_presensi' => $data_presensi,
            'total_anak_aktif' => $total_anak,
            'total_pemasukan' => $total_pemasukan,
            'total_presensi_perbulan' => $total_presensi_perbulan,
            'bulan_indo' => $inputan_bulan
        ];

        // dd($data);

        return view('excel/export_excel_peserta', $data);
    }

    public function export_invoice_mitra_ahl()
    {

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

            $harga_mitra = $this->presensiModel->getInvoiceMitraWithMonthSum($mitra_pengajar->mitra_id, $inputan_bulan, $inputan_tahun);
            $lain_lain = $this->klaimLainLainModel->getLainLainPerbulanDataMitraPengajar($mitra_pengajar->mitra_id, $inputan_bulan, $inputan_tahun);
            $kelompok_id = $this->kelompokModel->where(["mitra_pengajar_id" => $mitra_pengajar->mitra_id])->first();

            $presensi_data = $this->presensiModel->getInvoiceMitraData($mitra_pengajar->mitra_id, $inputan_bulan, $inputan_tahun);
            foreach ($presensi_data as $data) {
                $jumlah_anak = $data->jumlah_anak;
            }
            // $jumlah_anak = $this->kelompokBelajarModel->getUserWithKelompok($kelompok_id["id"]);
            // dd(intval($jumlah_anak));

            foreach ($upah_ahl as $upah_ahl) {
                $data_upah_ahl[] = [
                    'mitra_id' => $upah_ahl->mitra_ahl_id,
                    'nama_lengkap' => $upah_ahl->nama_lengkap,
                    'upah_mitra' => $upah_ahl->upah_mitra,
                    'bonus_kehadiran' => $upah_ahl->bonus_kehadiran,
                    'booster_penugasan' => $upah_ahl->booster_penugasan,
                    'penalangan' => $upah_ahl->penalangan,
                    'lain_lain' => $upah_ahl->lain_lain,
                    'pendapatan_ap' => intval($harga_mitra->total) + intval($lain_lain->total_lain_lain) + intval($lain_lain->total_booster) * intval($jumlah_anak),
                    'total_akhir' => intval($upah_ahl->upah_mitra) + intval($upah_ahl->penalangan) + intval($upah_ahl->bonus_kehadiran) + intval($upah_ahl->booster_penugasan) + intval($upah_ahl->lain_lain) + intval($harga_mitra->total) + intval($lain_lain->total_lain_lain) + intval($lain_lain->total_booster) * intval($jumlah_anak)
                ];
            }
        }

        // $total_presensi_perbulan = $this->presensiAhlModel->totalPresensiPerbulan($inputan_bulan, $inputan_tahun);
        // $total_presensi_perbulan_masuk = $this->presensiAhlModel->totalPresensiPerbulanMasuk($inputan_bulan, $inputan_tahun);
        // $total_presensi_perbulan_pulang = $this->presensiAhlModel->totalPresensiPerbulanPulang($inputan_bulan, $inputan_tahun);
        // $total_presensi_perbulan_dinas_luar = $this->presensiAhlModel->totalPresensiPerbulanDinasLuar($inputan_bulan, $inputan_tahun);

        $data = [
            'upah_ahl' => $data_upah_ahl,
            // 'total_presensi_perbulan' => $total_presensi_perbulan->total_presensi_perbulan,
            // 'total_presensi_perbulan_masuk' => $total_presensi_perbulan_masuk->total_presensi_perbulan_masuk,
            // 'total_presensi_perbulan_pulang' => $total_presensi_perbulan_pulang->total_presensi_perbulan_pulang,
            // 'total_presensi_perbulan_dinas_luar' => $total_presensi_perbulan_dinas_luar->total_presensi_perbulan_dinas_luar,
            'bulan_indo' => $inputan_bulan,
            'tahun' => $inputan_tahun
        ];

        return view('excel/export_excel_mitra_ahl', $data);
    }
}
