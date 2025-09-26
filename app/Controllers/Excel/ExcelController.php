<?php

namespace App\Controllers\Excel;

use App\Controllers\BaseController;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KelompokModel;
use App\Models\Admin\KlaimLainLainMitraModel;
use App\Models\Admin\KlaimMediaPesertaModel;
use App\Models\Admin\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class ExcelController extends BaseController
{
    protected $presensiModel;
    protected $kelompokBelajarModel;
    protected $klaimMediaPesertaModel;
    protected $klaimLainLainModel;
    protected $kelompokModel;
    protected $validation;

    public function __construct()
    {
        $this->presensiModel = new PresensiModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->klaimMediaPesertaModel = new KlaimMediaPesertaModel();
        $this->klaimLainLainModel = new KlaimLainLainMitraModel();
        $this->kelompokModel = new KelompokModel();
        $this->validation = \Config\Services::validation();
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

                // if ($booster_media->total_media == null) {
                //     $total_media = 0;
                // } else {
                //     $total_media  = $booster_media->total_media;
                // }

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
                    'booster_media' => intval($total_booster),
                    'total_media_belajar' => intval($total_media_anak),
                    'total_lain_lain' => intval($total_lain_lain),
                    'total_akhir' => intval($harga_mitra) + intval($total_booster) + intval($total_lain_lain) + intval($total_media_anak)
                ];
            }
        }

        $total_data = $this->presensiModel->sumTotalAnak($inputan_bulan, $inputan_tahun);

        $total_harga_mitra = $this->presensiModel->SumHargaPresensiMitra($inputan_bulan, $inputan_tahun);
        // dd($total_harga_mitra->total_harga_mitra);

        $total_harga_media = $this->klaimMediaPesertaModel->SumHargaMedia($inputan_bulan, $inputan_tahun);

        $total_lain_lain_mitra = $this->klaimLainLainModel->SumLainLainPerbulan($inputan_bulan, $inputan_tahun);

        $total_booster_media_mitra = $this->klaimLainLainModel->SumBoosterMediaPerbulan($inputan_bulan, $inputan_tahun);

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

        // booster_media
        // if ($total_harga_mitra->total_booster == null) {
        //     $total_booster = intval(0);
        // } else {
        //     $total_booster = intval($total_harga_mitra->total_booster);
        // }

        if ($total_booster_media_mitra->total_booster_media_mitra == null) {
            $total_booster = intval(0);
        } else {
            $total_booster = intval($total_booster_media_mitra->total_booster_media_mitra);
        }

        // media belajar
        if ($total_harga_media->total_harga_media == null) {
            $total_media = intval(0);
        } else {
            $total_media = intval($total_harga_media->total_harga_media);
        }

        // lain_lain
        if ($total_lain_lain_mitra->total_lain_lain == null) {
            $total_lain_lain = intval(0);
        } else {
            $total_lain_lain = intval($total_lain_lain_mitra->total_lain_lain);
        }

        $total_pemasukan = $total_harga + $total_booster + $total_media + $total_lain_lain;

        $data = [
            'data_presensi' => $data_presensi,
            'total_anak_aktif' => $total_anak,
            'total_presensi_perbulan' => $total_presensi_perbulan,
            'total_pemasukan' => $total_pemasukan,
            'harga_mitra' => $harga_mitra,
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
            'total_pemasukan' => $total_pemasukan,
            'total_presensi_perbulan' => $total_presensi_perbulan,
            'bulan_indo' => $inputan_bulan
        ];

        // dd($data);

        return view('excel/export_excel_peserta', $data);
    }
}
