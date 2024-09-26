<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Admin\ProgramBelajarModel;
use App\Models\Admin\StatusMuridModel;
use App\Models\Mitra\KelompokBelajarModel;
use App\Models\Mitra\MateriBelajarModel;
use App\Models\Mitra\MuridModel;
use CodeIgniter\HTTP\ResponseInterface;

class MuridController extends BaseController
{
    protected $muridModel;
    protected $kelompokBelajarModel;
    protected $statusMuridModel;
    protected $programBelajarModel;
    protected $materiBelajarModel;

    protected $validation;

    public function __construct()
    {
        $this->muridModel = new MuridModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->statusMuridModel = new StatusMuridModel();
        $this->programBelajarModel = new ProgramBelajarModel();
        $this->materiBelajarModel = new MateriBelajarModel();

        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data_murid = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar(session()->get('mitra_pengajar_id'));

        $data = [
            'title' => 'Peserta Didik',
            'status_murid' => $this->statusMuridModel->getStatusMurid(),
            'program_belajar' => $this->programBelajarModel->getProgramBelajar(),
            'materi_belajar' => $this->materiBelajarModel->getMateriBelajar(),
            'data_murid' => $data_murid,
        ];

        return view('mitra/murid_v', $data);
    }

    public function view($id)
    {


        if ($id == null) {
            return redirect()->to('/mitra_pengajar/data_murid');
        }

        $profil = $this->muridModel->getMitraMurid($id);

        if ($profil == null) {
            return redirect()->to('/mitra_pengajar/data_murid');
        }

        $data = [
            'title' => 'Peserta Didik',
            'profil' => $profil,
        ];

        return view('mitra/profil_murid_v', $data);
    }
}
