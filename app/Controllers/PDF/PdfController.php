<?php

namespace App\Controllers\PDF;

use App\Controllers\BaseController;
use App\Models\Admin\HargaMitraModel;
use App\Models\Admin\HargaModel;
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

    public function __construct()
    {
        $this->mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'B4-L']);
        $this->presensiModel = new PresensiModel();
        $this->pengajarModel = new PengajarModel();
        $this->hargaModel = new HargaModel();
        $this->hargaMitraModel = new HargaMitraModel();
        $this->mediaBelajarModel = new MediaBelajarModel();
        $this->muridModel = new MuridModel();
    }

    public function index()
    {
        $this->mpdf->showImageErrors = true;
        $mitra_pengajar_id = $this->request->getVar('mitra_pengajar_id');
        $peserta_didik = $this->request->getVar('peserta_didik_id');
        $bulan = $this->request->getVar('bulan');
        helper(['format']);

        $invoice = $this->presensiModel->getPresensiWithMonth($mitra_pengajar_id, $bulan, $peserta_didik);
        $pengajar = $this->pengajarModel->getMitraPengajarWithId($mitra_pengajar_id);

        $harga_perjam = $this->hargaModel->getHargaPerbulan($peserta_didik, $bulan);

        $total = count($invoice);

        $peserta_didik_data = $this->muridModel->where(["id" => $peserta_didik])->get()->getRowObject();

        $data = [
            'invoice' =>  $invoice,
            'mitra_pengajar' => $pengajar,
            'peserta_didik' => $peserta_didik_data->nama_lengkap_anak,
            'harga' => $harga_perjam->harga,
            'total' => $total,

        ];

        $html = view('pdf/invoice_pdf', $data);
        $this->mpdf->WriteHTML($html);

        $this->response->setHeader('Content-Type', 'application/pdf');;
        $this->mpdf->output('Invoice-' . $peserta_didik_data->nama_lengkap_anak . '.pdf', 'I');
    }

    public function mitra($mitra_pengajar_id, $bulan)
    {

        // dd($mitra_pengajar_id, $bulan, $harga_media);
        $this->mpdf->showImageErrors = true;

        $mitra_pengajar_id = $mitra_pengajar_id;

        $bulan = $bulan;

        helper(['format']);

        $invoice = $this->presensiModel->getPresensiMitraWithMonth($mitra_pengajar_id, $bulan);

        if ($invoice == null) {

            $error = [
                'error' => 'Data Tidak Ditemukan!'
            ];
            session()->setFlashdata($error);
            return redirect()->back()->withInput($error);
        }

        $pengajar = $this->pengajarModel->getMitraPengajarWithId($mitra_pengajar_id);

        $harga = $this->hargaMitraModel->getInvoice($mitra_pengajar_id, $bulan);

        $media_belajar = $this->mediaBelajarModel->getMediaBelajar($mitra_pengajar_id, $bulan);

        $total = count($invoice);

        $data = [
            'invoice' =>  $invoice,
            'mitra_pengajar' => $pengajar,
            'harga' => $harga,
            'total' => $total,
            'media_belajar' => $media_belajar
        ];

        $html = view('pdf/invoice_mitra_pdf', $data);
        $this->mpdf->WriteHTML($html);

        $this->response->setHeader('Content-Type', 'application/pdf');;
        $this->mpdf->output('Invoice-' . $pengajar->nama_lengkap  . '.pdf', 'I');
    }
}
