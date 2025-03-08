<?php

namespace App\Controllers\PDF;

use App\Controllers\BaseController;
use App\Models\Admin\HargaMitraModel;
use App\Models\Admin\HargaModel;
use App\Models\Admin\KlaimLainLainMitraModel;
use App\Models\Admin\KlaimMediaPesertaModel;
use App\Models\Admin\MediaBelajarModel;
use App\Models\Admin\MuridModel;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class PdfController extends BaseController
{
    protected $mpdf;
    protected $presensiModel;
    protected $pengajarModel;
    protected $hargaModel;
    protected $hargaMitraModel;
    protected $muridModel;
    protected $mediaBelajarModel;
    protected $klaimLainLainModel;
    protected $klaimMediaPesertaModel;

    public function __construct()
    {
        $this->mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'B4-L']);
        $this->presensiModel = new PresensiModel();
        $this->pengajarModel = new PengajarModel();
        $this->hargaModel = new HargaModel();
        $this->hargaMitraModel = new HargaMitraModel();
        $this->mediaBelajarModel = new MediaBelajarModel();
        $this->muridModel = new MuridModel();
        $this->klaimLainLainModel = new KlaimLainLainMitraModel();
        $this->klaimMediaPesertaModel = new KlaimMediaPesertaModel();
    }

    public function invoice_peserta_didik($mitra_pengajar_id, $peserta_didik_id, $bulan)
    {
        $this->mpdf->showImageErrors = true;

        helper(['format']);

        $mitra = $this->pengajarModel->where(["id" => $mitra_pengajar_id])->get()->getRowObject();
        $peserta = $this->muridModel->where(["id" => $peserta_didik_id])->get()->getRowObject();

        if ($mitra == null || $peserta == null || $bulan == null) {
            return redirect()->back();
        }

        $mitra_data = $mitra->id;
        $peserta_data = $peserta->id;

        $bulan = $bulan;
        $tahun = date('Y');

        // dd($bulan);
        // $tahun = 2024;

        $invoice = $this->presensiModel->getPresensiWithMonth($mitra_data, $bulan, $peserta_data);

        $pengajar = $this->pengajarModel->getMitraPengajarWithId($mitra_data);

        $harga_perjam = $this->hargaModel->getHargaPerbulanPeserta($peserta_data, $bulan, $tahun);

        // dd($harga_perjam);

        $total = count($invoice);

        $peserta_didik_data = $this->muridModel->where(["id" => $peserta_data])->get()->getRowObject();

        $jumlah_pertemuan = count($invoice);

        $data = [
            'invoice' =>  $invoice,
            'mitra_pengajar' => $pengajar,
            'peserta_didik' => $peserta_didik_data->nama_lengkap_anak,
            'harga' => $harga_perjam,
            'jumlah_pertemuan' => $jumlah_pertemuan,
            'total' => $total,
        ];

        $html = view('pdf/invoice_pdf', $data);
        $this->mpdf->WriteHTML($html);

        $this->response->setHeader('Content-Type', 'application/pdf');;
        $this->mpdf->output('Invoice-' . $peserta_didik_data->nama_lengkap_anak . '.pdf', 'I');
    }



    public function mitra($mitra_pengajar_id, $bulan, $tahun)
    {

        $this->mpdf->showImageErrors = true;

        $mitra_pengajar_id = $mitra_pengajar_id;

        $bulan = $bulan;

        $tahun = $tahun;


        helper(['format']);

        $invoice = $this->presensiModel->getInvoiceMitraWithMonth($mitra_pengajar_id, $bulan, $tahun);

        // dd($invoice);

        if (count($invoice) == 0) {

            $error = [
                'error' => 'Data Tidak Ditemukan!'
            ];

            session()->setFlashdata($error);
            return redirect()->back()->withInput($error);
        } else {

            $pengajar = $this->pengajarModel->getMitraPengajarWithId($mitra_pengajar_id);

            $total = $this->presensiModel->getInvoiceMitraWithMonthSum($mitra_pengajar_id, $bulan, $tahun);

            $booster_media = $this->presensiModel->getMediaMitraWithMonthSum($mitra_pengajar_id, $bulan, $tahun);

            $lain_lain = $this->klaimLainLainModel->getLainLainPerbulanDataMitraPengajar($mitra_pengajar_id, $bulan, $tahun);

            $media_belajar_anak = $this->klaimMediaPesertaModel->SumHargaMediaWithMitra($mitra_pengajar_id, $bulan, $tahun);

            if ($total->total == null) {
                $total = intval(0);
            } else {
                $total = intval($total->total);
            }

            if ($booster_media->total_media == null) {
                $total_media = intval(0);
            } else {
                $total_media = intval($booster_media->total_media);
            }

            if ($lain_lain->total_lain_lain == null) {
                $total_lain_lain = intval(0);
            } else {
                $total_lain_lain = intval($lain_lain->total_lain_lain);
            }

            if ($media_belajar_anak->total_harga_media == null) {
                $total_harga_media = intval(0);
            } else {
                $total_harga_media = intval($media_belajar_anak->total_harga_media);
            }


            $data = [
                'invoice' =>  $invoice,
                'mitra_pengajar' => $pengajar,
                'total' => $total,
                'booster_media' => $total_media,
                'lain_lain' => $total_lain_lain,
                'media_belajar' => $total_harga_media,

            ];

            $html = view('pdf/invoice_mitra_pdf', $data);
            $this->mpdf->WriteHTML($html);

            $this->response->setHeader('Content-Type', 'application/pdf');;
            $this->mpdf->output('Invoice-' . $pengajar->nama_lengkap  . '.pdf', 'I');
        }
    }
}
