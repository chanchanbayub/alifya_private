<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\PesertaDidikAhlModel;
use CodeIgniter\HTTP\ResponseInterface;

class InvoicePesertaController extends BaseController
{

    protected $validation;
    protected $pesertaDidikAhlModel;

    public function __construct()
    {
        $this->pesertaDidikAhlModel = new PesertaDidikAhlModel();
        $this->validation = \Config\Services::validation();

        helper(['format']);
    }


    public function index()
    {
        $data = [
            'title' => 'Invoice Peserta Didik AHL',
            'peserta_didik' => $this->pesertaDidikAhlModel->getPesertaDidikAhl()
            // 'presensi_ahl' => $this->presensiAhlModel->getPresensiAhl(),
            // 'lokasi' => $this->lokasiModel->getLokasi(),
            // 'jenis_pekerjaan' => $this->jenisPekerjaanModel->getJenisPekerjaan(),
            // 'status_presensi' => $this->statusPresensiModel->getStatusPresensi(),
            // 'mitra_pengajar_ahl' => $this->mitraPengajarAhlModel->getMitraPengajarAhl(),
        ];

        return view('ahl/invoice_peserta_ahl_v', $data);
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

                // $pengajar_data = $this->kelompokModel->getKelompokPengajar();

                // $data_presensi = [];

                // foreach ($pengajar_data as $mitra_pengajar) {

                //     $presensi_data = $this->presensiModel->getInvoiceMitraData($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

                //     $harga_mitra = $this->presensiModel->getInvoiceMitraWithMonthSum($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

                //     $booster_media = $this->presensiModel->getMediaMitraWithMonthSum($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

                //     $lain_lain = $this->klaimLainLainModel->getLainLainPerbulanDataMitraPengajar($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

                //     $media_belajar_anak = $this->klaimMediaPesertaModel->SumHargaMediaWithMitra($mitra_pengajar->mitra_pengajar_id, $inputan_bulan, $inputan_tahun);

                //     foreach ($presensi_data as $data_peserta) {

                //         if ($data_peserta->total_presensi == null) {
                //             $total_presensi = 0;
                //         } else {
                //             $total_presensi = $data_peserta->total_presensi;
                //         }

                //         if ($harga_mitra->total == null) {
                //             $harga_mitra = 0;
                //         } else {
                //             $harga_mitra = $harga_mitra->total;
                //         }

                //         if ($booster_media->total_media == null) {
                //             $total_media = 0;
                //         } else {
                //             $total_media  = $booster_media->total_media;
                //         }

                //         if ($media_belajar_anak->total_harga_media == null) {
                //             $total_media_anak = 0;
                //         } else {
                //             $total_media_anak  = $media_belajar_anak->total_harga_media;
                //         }

                //         if ($lain_lain->total_lain_lain == null) {
                //             $total_lain_lain = 0;
                //         } else {
                //             $total_lain_lain  = $lain_lain->total_lain_lain;
                //         }

                //         $data_presensi[] = [
                //             'data_pengajar_id' => $mitra_pengajar->mitra_pengajar_id,
                //             'bulan' => $inputan_bulan,
                //             'tahun' => $inputan_tahun,
                //             'mitra_pengajar_id' => $mitra_pengajar->mitra_pengajar_id,
                //             'jumlah_anak' => $data_peserta->jumlah_anak,
                //             'nama_lengkap' => $mitra_pengajar->nama_lengkap,
                //             'total_presensi' => intval($total_presensi),
                //             'harga_mitra' => intval($harga_mitra),
                //             'booster_media' => intval($total_media),
                //             'total_media_belajar' => intval($total_media_anak),
                //             'total_lain_lain' => intval($total_lain_lain),
                //             'total_akhir' => intval($harga_mitra) + intval($total_media) + intval($total_lain_lain) + intval($total_media_anak)
                //         ];
                //     }
                // }

                // $total_data = $this->presensiModel->sumTotalAnak($inputan_bulan, $inputan_tahun);

                // $total_harga_mitra = $this->presensiModel->SumHargaPresensiMitra($inputan_bulan, $inputan_tahun);
                // // dd($total_harga_mitra->total_harga_mitra);

                // $total_harga_media = $this->klaimMediaPesertaModel->SumHargaMedia($inputan_bulan, $inputan_tahun);

                // $total_lain_lain_mitra = $this->klaimLainLainModel->SumLainLainPerbulan($inputan_bulan, $inputan_tahun);

                // // data anak
                // if ($total_data->total_anak == null) {
                //     $total_anak = intval(0);
                // } else {
                //     $total_anak =  intval($total_data->total_anak);
                // }
                // // data Presensi perbulan
                // if ($total_data->total_presensi_perbulan == null) {
                //     $total_presensi_perbulan = intval(0);
                // } else {
                //     $total_presensi_perbulan = intval($total_data->total_presensi_perbulan);
                // }

                // // harga_mitra
                // if ($total_harga_mitra->total_harga_mitra == null) {
                //     $total_harga = intval(0);
                // } else {
                //     $total_harga = intval($total_harga_mitra->total_harga_mitra);
                // }

                // // booster_media
                // if ($total_harga_mitra->total_booster == null) {
                //     $total_booster = intval(0);
                // } else {
                //     $total_booster = intval($total_harga_mitra->total_booster);
                // }

                // // media belajar
                // if ($total_harga_media->total_harga_media == null) {
                //     $total_media = intval(0);
                // } else {
                //     $total_media = intval($total_harga_media->total_harga_media);
                // }

                // // lain_lain
                // if ($total_lain_lain_mitra->total_lain_lain == null) {
                //     $total_lain_lain = intval(0);
                // } else {
                //     $total_lain_lain = intval($total_lain_lain_mitra->total_lain_lain);
                // }

                // $total_pemasukan = $total_harga + $total_booster + $total_media + $total_lain_lain;

                // $alert = [
                //     'data_presensi' => $data_presensi,
                //     'total_anak_aktif' => $total_anak,
                //     'total_presensi_perbulan' => $total_presensi_perbulan,
                //     'total_pemasukan' => $total_pemasukan,
                //     'harga_mitra' => $harga_mitra
                // ];
            }

            return json_encode($alert);
        }
    }
}
