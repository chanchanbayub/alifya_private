<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KelompokModel;
use App\Models\Admin\MuridModel;
use App\Models\Admin\PengajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    protected $pengajarModel;
    protected $muridModel;
    protected $kelompokModel;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->muridModel = new MuridModel();
        $this->kelompokModel = new KelompokModel();
    }

    public function index()
    {
        $mitra_pengajar_pendaftaran = $this->pengajarModel->getDataPengajarStatusWaiting();
        $mitra_pengajar_aktif = $this->pengajarModel->getDataPengajarStatusAktif();
        $mitra_pengajar = $this->pengajarModel->getDataPengajar();

        $peserta_didik = $this->muridModel->getDataMurid();
        $peserta_didik_aktif = $this->muridModel->getDataMuridAktif();
        $peserta_didik_waiting = $this->muridModel->getDataMuridWaiting();
        $peserta_didik_pendaftaran = $this->muridModel->getDataMuridPendaftaran();
        $peserta_didik_off = $this->muridModel->getDataMuridOff();

        $data = [
            'title' => 'Dashboard',
            'mitra_pengajar' => count($mitra_pengajar),
            'mitra_pengajar_aktif' => count($mitra_pengajar_aktif),
            'mitra_pengajar_pendaftaran' => count($mitra_pengajar_pendaftaran),

            'peserta_didik' => count($peserta_didik),
            'peserta_didik_aktif' => count($peserta_didik_aktif),
            'peserta_didik_pendaftaran' => count($peserta_didik_pendaftaran),
            'peserta_didik_waiting' => count($peserta_didik_waiting),
            'peserta_didik_off' => count($peserta_didik_off),
        ];
        return view('admin/dashboard_v', $data);
    }
}
