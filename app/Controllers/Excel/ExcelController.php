<?php

namespace App\Controllers\Excel;

use App\Controllers\BaseController;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KlaimMediaPesertaModel;
use App\Models\Admin\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class ExcelController extends BaseController
{
    protected $presensiModel;
    protected $kelompokBelajarModel;
    protected $klaimMediaPesertaModel;
    protected $validation;

    public function __construct()
    {
        $this->presensiModel = new PresensiModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->klaimMediaPesertaModel = new KlaimMediaPesertaModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        helper(['format']);

        $bulan = $this->request->getVar('bulan');

        $data_bulan = explode("-", $bulan);

        $inputan_bulan = intval($data_bulan[1]);
        $inputan_tahun = intval($data_bulan[0]);

        $peserta_didik = $this->kelompokBelajarModel->getKelompokBelajar();

        $data_presensi = [];
        foreach ($peserta_didik as $data_anak) {

            $presensi_data = $this->presensiModel->getPresensiPerAnak($data_anak->peserta_didik_id, $inputan_bulan, $inputan_tahun);

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

                if ($data_peserta->total_presensi_perbulan == null) {
                    $total_presensi_perbulan = 0;
                } else {
                    $total_presensi_perbulan  = $data_peserta->total_presensi_perbulan;
                }

                $data_presensi[] = [
                    'id' => $data_peserta->id,
                    'mitra_pengajar_id' => $data_peserta->mitra_pengajar_id,
                    'bulan' => $data_peserta->bulan,
                    'nama_lengkap' => $data_peserta->nama_lengkap,
                    'nama_lengkap_anak' => $data_peserta->nama_lengkap_anak,
                    'total_presensi_perbulan' => intval($total_presensi_perbulan),
                    'harga' =>  intval($harga),
                    'jumlah_upah' => intval($harga) * intval($total_presensi_perbulan),
                    'media_belajar' => intval($harga_media),
                    'lain_lain' => intval($lain_lain),
                    'total_akhir' => intval($total_presensi_perbulan) * intval($harga) + intval($harga_media) + intval($lain_lain)
                ];
            }
        }

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

        $total_pemasukan = intval($total_bayar) + intval($total_media) + intval($total_lain_lain);

        $data = [
            'data_presensi' => $data_presensi,
            'title' => 'Invoice Peserta Didik',
            'total_pemasukan' => $total_pemasukan,
            'bulan_indo' => $inputan_bulan
        ];

        return view('excel/export_excel', $data);
    }
}
