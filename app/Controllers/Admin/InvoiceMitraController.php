<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HargaMitraModel;
use App\Models\Admin\HargaModel;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KelompokModel;
use App\Models\Admin\KlaimLainLainMitraModel;
use App\Models\Admin\KlaimMediaPesertaModel;
use App\Models\Admin\MediaBelajarModel;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class InvoiceMitraController extends BaseController
{
    protected $presensiModel;
    protected $kelompokModel;
    protected $pengajarModel;
    protected $kelompokBelajarModel;
    protected $hargaModel;
    protected $validation;
    protected $hargaMitraModel;
    protected $klaimMediaPesertaModel;
    protected $klaimLainLainModel;

    public function __construct()
    {
        $this->presensiModel = new PresensiModel();
        $this->kelompokModel = new KelompokModel();
        $this->pengajarModel = new PengajarModel();
        $this->hargaModel = new HargaModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->validation = \Config\Services::validation();
        $this->hargaMitraModel = new HargaMitraModel();
        $this->klaimMediaPesertaModel = new KlaimMediaPesertaModel();
        $this->klaimLainLainModel = new KlaimLainLainMitraModel();
    }

    public function index()
    {
        $mitra_pengajar = $this->kelompokModel->getKelompokPengajar();

        $data = [
            'title' => 'Invoice Mitra Pengajar',
            'mitra_pengajar' => $mitra_pengajar,
        ];

        return view('admin/invoice_mitra_v', $data);
    }

    public function getPesertaDidik()
    {
        if ($this->request->isAJAX()) {

            $mitra_pengajar_id = $this->request->getVar('mitra_pengajar_id');

            $peserta_didik = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar($mitra_pengajar_id);

            $data = [
                'peserta_didik' => $peserta_didik
            ];

            return json_encode($data);
        }
    }


    public function getInvoiceMitra()
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

                $pengajar_data = $this->kelompokModel->getKelompokPengajar();

                $data_presensi = [];

                foreach ($pengajar_data as $mitra_pengajar) {

                    $presensi_data = $this->presensiModel->getInvoiceMitraData($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

                    $harga_mitra = $this->presensiModel->getInvoiceMitraWithMonthSum($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

                    // $harga_media = $this->hargaMitraModel->getHargaMitraPerbulan($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

                    $booster_media = $this->presensiModel->getMediaMitraWithMonthSum($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

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

                        // if ($harga_media->booster_media == null) {
                        //     $total_booster = 0;
                        // } else {
                        //     $total_booster = $harga_media->booster_media;
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
                            'booster_mitra' => intval($total_booster),
                            'total_jumlah_booster' => intval($data_peserta->jumlah_anak) * intval($total_booster),
                            'total_media_belajar' => intval($total_media_anak),
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

                $alert = [
                    'data_presensi' => $data_presensi,
                    'total_anak_aktif' => $total_anak,
                    'total_presensi_perbulan' => $total_presensi_perbulan,
                    'total_pemasukan' => $total_pemasukan,
                    'harga_mitra' => $harga_mitra
                ];
            }

            return json_encode($alert);
        }
    }
}
