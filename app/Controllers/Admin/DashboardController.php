<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KelompokModel;
use App\Models\Admin\MuridModel;
use App\Models\Admin\PengajarModel;
use App\Models\Ahl\MitraPengajarAhlModel;
use App\Models\Ahl\PesertaDidikAhlModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    protected $pengajarModel;
    protected $muridModel;
    protected $kelompokModel;
    protected $mitraPengajarAhlModel;
    protected $pesertaDidikAhlModel;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->muridModel = new MuridModel();
        $this->kelompokModel = new KelompokModel();
        $this->mitraPengajarAhlModel = new MitraPengajarAhlModel();
        $this->pesertaDidikAhlModel = new PesertaDidikAhlModel();
    }

    public function index()
    {
        $mitra_pengajar_pendaftaran = $this->pengajarModel->getDataPengajarStatusWaiting();
        $mitra_pengajar_aktif = $this->pengajarModel->getDataPengajarStatusAktif();
        $mitra_pengajar_off = $this->pengajarModel->getDataPengajarStatusOff();
        $mitra_pengajar = $this->pengajarModel->getDataPengajar();

        $peserta_didik = $this->muridModel->getDataMurid();
        $peserta_didik_aktif = $this->muridModel->getDataMuridAktif();
        $peserta_didik_waiting = $this->muridModel->getDataMuridWaiting();
        $peserta_didik_pendaftaran = $this->muridModel->getDataMuridPendaftaran();
        $peserta_didik_off = $this->muridModel->getDataMuridOff();

        $mitra_pengajar_ahl = $this->mitraPengajarAhlModel->findAll();

        $peserta_didik_ahl = $this->pesertaDidikAhlModel->findAll();
        $peserta_didik_ahl_aktif = $this->pesertaDidikAhlModel->getPesertaDidikAhlAktif();
        $peserta_didik_ahl_waiting = $this->pesertaDidikAhlModel->getPesertaDidikAhlWaiting();
        $peserta_didik_ahl_pendaftaran = $this->pesertaDidikAhlModel->getPesertaDidikAhlPendaftaran();
        $peserta_didik_ahl_off = $this->pesertaDidikAhlModel->getPesertaDidikAhlOff();


        $data = [
            'title' => 'Dashboard',
            'mitra_pengajar' => count($mitra_pengajar),
            'mitra_pengajar_aktif' => count($mitra_pengajar_aktif),
            'mitra_pengajar_pendaftaran' => count($mitra_pengajar_pendaftaran),
            'mitra_pengajar_off' => count($mitra_pengajar_off),

            'peserta_didik' => count($peserta_didik),
            'peserta_didik_aktif' => count($peserta_didik_aktif),
            'peserta_didik_pendaftaran' => count($peserta_didik_pendaftaran),
            'peserta_didik_waiting' => count($peserta_didik_waiting),
            'peserta_didik_off' => count($peserta_didik_off),

            'mitra_pengajar_ahl' => count($mitra_pengajar_ahl),

            'peserta_didik_ahl' => count($peserta_didik_ahl),
            'peserta_didik_ahl_aktif' => count($peserta_didik_ahl_aktif),
            'peserta_didik_ahl_pendaftaran' => count($peserta_didik_ahl_pendaftaran),
            'peserta_didik_ahl_waiting' => count($peserta_didik_ahl_waiting),
            'peserta_didik_ahl_off' => count($peserta_didik_ahl_off),

        ];
        return view('admin/dashboard_v', $data);
    }
}
