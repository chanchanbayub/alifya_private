<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HargaModel;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KelompokModel;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class InvoiceController extends BaseController
{
    protected $presensiModel;
    protected $kelompokModel;
    protected $pengajarModel;
    protected $kelompokBelajarModel;
    protected $hargaModel;
    protected $validation;

    public function __construct()
    {
        $this->presensiModel = new PresensiModel();
        $this->kelompokModel = new KelompokModel();
        $this->pengajarModel = new PengajarModel();
        $this->hargaModel = new HargaModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $mitra_pengajar = $this->kelompokModel->getKelompokPengajar();
        $harga = $this->hargaModel->getHarga();

        $data = [
            'title' => 'Invoice Peserta Didik',
            'mitra_pengajar' => $mitra_pengajar,
            'harga' => $harga
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

            $harga_perjam = $this->hargaModel->where(["peserta_didik_id" => $peserta_didik_id])->get()->getResultObject();

            $data = [
                'harga_perjam' => $harga_perjam
            ];

            return json_encode($data);
        }
    }
}
