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

                // DD($inputan_bulan);

                $pengajar_data = $this->kelompokModel->getKelompokPengajar();



                $data_presensi = [];

                foreach ($pengajar_data as $mitra_pengajar) {

                    $presensi_data = $this->presensiModel->getInvoiceMitraData($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);
                    $harga_mitra = $this->presensiModel->getInvoiceMitraWithMonthSum($mitra_pengajar->mitra_pengajar_id, $inputan_bulan);
                    $booster_media = $this->presensiModel->getMediaMitraWithMonthSum($mitra_pengajar->mitra_pengajar_id, $inputan_bulan);
                    $lain_lain = $this->klaimLainLainModel->getLainLainPerbulanDataMitraPengajar($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

                    $media_belajar_anak = $this->klaimMediaPesertaModel->SumHargaMediaWithMitra($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

                    // $jumlah_anak = $this->presensiModel->SumPesertaDidikPerbulan($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);



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

                        if ($booster_media->total_media == null) {
                            $total_media = 0;
                        } else {
                            $total_media  = $booster_media->total_media;
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

                        $data_presensi[] = [
                            'data_pengajar_id' => $data_peserta->id,
                            'mitra_pengajar_id' => $data_peserta->id,
                            // 'jumlah_anak' => $data_peserta->jumlah_anak,
                            'nama_lengkap' => $data_peserta->nama_lengkap,
                            'total_presensi' => intval($total_presensi),
                            'harga_mitra' => intval($harga_mitra),
                            'booster_media' => intval($total_media),
                            'total_media_belajar' => intval($total_media_anak),
                            'total_lain_lain' => intval($total_lain_lain),
                            'total_akhir' => intval($harga_mitra) + intval($total_media) + intval($total_lain_lain) + intval($total_media_anak)
                        ];
                    }
                }



                $total_anak_aktif = $this->kelompokBelajarModel->sumTotalAnak();


                // $total_harga = $this->presensiModel->SumHargaPresensi($bulan, $tahun);
                // dd($total_harga);
                // $total_harga_media = $this->klaimMediaPesertaModel->SumHargaMedia($bulan, $tahun);



                // if ($total_harga->total_harga == null) {
                //     $total_bayar = "0";
                // } else {
                //     $total_bayar = $total_harga->total_harga;
                // }

                // if ($total_harga_media->total_harga_media == null) {
                //     $total_media = "0";
                // } else {
                //     $total_media = $total_harga_media->total_harga_media;
                // }

                // if ($total_harga_media->total_lain_lain == null) {
                //     $total_lain_lain = "0";
                // } else {
                //     $total_lain_lain = $total_harga_media->total_lain_lain;
                // }

                // $total_pemasukan = intval($total_bayar) + intval($total_media) + intval($total_lain_lain);
                // dd($total_pemasukan);

                $alert = [
                    'data_presensi' => $data_presensi,
                    'total_anak_aktif' => $total_anak_aktif->total_anak,
                    // 'jumlah_anak' => $jumlah_anak

                ];
            }

            return json_encode($alert);
        }
    }
}
