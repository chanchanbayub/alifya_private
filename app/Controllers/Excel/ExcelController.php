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
        $date = $this->request->getVar('bulan');

        $date_data = explode("-", $date);

        $tahun = $date_data["0"];
        $bulan = date('j', strtotime($date_data["1"]));

        $peserta_didik = $this->kelompokBelajarModel->getKelompokBelajar();


        $data_presensi = [];
        foreach ($peserta_didik as $data_anak) {

            $presensi_data = $this->presensiModel->getPresensiPerAnak($data_anak->peserta_didik_id, $bulan, $tahun);
            foreach ($presensi_data as $data_peserta) {
                $data_presensi[] = $data_peserta;
            }
        }

        $total_harga = $this->presensiModel->SumHargaPresensi($bulan, $tahun);

        $total_harga_media = $this->klaimMediaPesertaModel->SumHargaMedia($bulan, $tahun);

        $total_pemasukan = $total_harga->total_harga + $total_harga_media->total_harga_media + $total_harga_media->total_lain_lain;

        $data = [
            'data_presensi' => $data_presensi,
            'title' => 'Invoice Peserta Didik',
            'total_pemasukan' => $total_pemasukan
        ];

        return view('excel/export_excel', $data);
    }
}
