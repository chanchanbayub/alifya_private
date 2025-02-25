<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Admin\HargaModel;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KelompokModel;
use App\Models\Admin\KlaimMediaPesertaModel;
use App\Models\Admin\MuridModel;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class InvoiceController extends BaseController
{
    protected $presensiModel;
    protected $kelompokModel;
    protected $pengajarModel;
    protected $kelompokBelajarModel;
    protected $klaimMediaPesertaModel;
    protected $muridModel;
    protected $hargaModel;
    protected $validation;

    public function __construct()
    {
        $this->presensiModel = new PresensiModel();
        $this->kelompokModel = new KelompokModel();
        $this->pengajarModel = new PengajarModel();
        $this->hargaModel = new HargaModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->muridModel = new MuridModel();
        $this->klaimMediaPesertaModel = new KlaimMediaPesertaModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        helper(['format']);

        $bulan = date('n');
        // dd($bulan);

        $tahun = date('Y');
        // dd($tahun);

        // $peserta_didik = $this->muridModel->getPesertaDidikData();
        $peserta_didik = $this->kelompokBelajarModel->getKelompokBelajar();


        $data_presensi = [];
        foreach ($peserta_didik as $data_anak) {

            $presensi_data = $this->presensiModel->getPresensiPerAnak($data_anak->peserta_didik_id, $bulan, $tahun);
            // dd($presensi_data);
            foreach ($presensi_data as $data_peserta) {
                $data_presensi[] = [
                    'id' => $data_peserta->id,
                    'mitra_pengajar_id' => $data_peserta->mitra_pengajar_id,
                    'bulan' => $data_peserta->bulan,
                    // 'tahun' => $data_peserta->tahun,
                    'nama_lengkap' => $data_peserta->nama_lengkap,
                    'nama_lengkap_anak' => $data_peserta->nama_lengkap_anak,
                    'total_presensi_perbulan' => $data_peserta->total_presensi_perbulan,
                    'harga' => $data_peserta->harga,
                    'jumlah_upah' => $data_peserta->harga * $data_peserta->total_presensi_perbulan,
                    'media_belajar' => $data_peserta->harga_media,
                    'lain_lain' => $data_peserta->lain_lain,
                    'total_akhir' => $data_peserta->total_presensi_perbulan * $data_peserta->harga + $data_peserta->harga_media + $data_peserta->lain_lain

                ];
            }
        }


        // dd($data_presensi);
        $total_harga = $this->presensiModel->SumHargaPresensi($bulan, $tahun);
        $total_harga_media = $this->klaimMediaPesertaModel->SumHargaMedia($bulan, $tahun);
        // dd($total_harga);

        $total_pemasukan = $total_harga->total_harga + $total_harga_media->total_harga_media + $total_harga_media->total_lain_lain;


        $data = [
            'data_presensi' => $data_presensi,
            'title' => 'Invoice Peserta Didik',
            'total_pemasukan' => $total_pemasukan,
            'jumlah_data_presensi' => count($data_presensi)
        ];

        return view('admin/invoice_v', $data);
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

    public function getHargaPeserta()
    {
        if ($this->request->isAJAX()) {

            $peserta_didik_id = $this->request->getVar('peserta_didik_id');

            $harga_perjam = $this->hargaModel->where(["peserta_didik_id" => $peserta_didik_id])->get()->getRowObject();

            $data = [
                'harga_perjam' => $harga_perjam
            ];

            return json_encode($data);
        }
    }
}
