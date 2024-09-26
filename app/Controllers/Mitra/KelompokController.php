<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Mitra\KelompokBelajarModel;
use App\Models\Mitra\KelompokModel;
use App\Models\Mitra\MuridModel;
use App\Models\Mitra\PengajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class KelompokController extends BaseController
{
    protected $kelompokModel;
    protected $muridModel;
    protected $kelompokBelajarModel;
    protected $pengajarModel;

    protected $validation;

    public function __construct()
    {
        $this->kelompokModel = new KelompokModel();
        $this->pengajarModel = new PengajarModel();
        $this->muridModel = new MuridModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $kelompok = $this->kelompokModel->getKelompokPengajarWithMitraPengajar(session()->get('mitra_pengajar_id'));
        // dd($kelompok);

        $data = [
            'title' => 'Kelompok Pengajar',
            'kelompok' => $kelompok
        ];

        return view('mitra/kelompok_v', $data);
    }

    public function views($id)
    {

        $kelompok = $this->kelompokModel->getKelompokWithId($id);
        $kelompok_belajar = $this->kelompokBelajarModel->getUserWithKelompok($id);

        // dd($kelompok_belajar);
        // dd($kelompok_belajar);
        $data = [
            'title' => 'Kelompok Belajar ',
            'kelompok' => $kelompok,
            'kelompok_belajar' => $kelompok_belajar
        ];

        return view('mitra/detail_kelompok_v', $data);
    }
}
