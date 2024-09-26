<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Admin\StatusPengajarModel;
use App\Models\Mitra\PengajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class PengajarController extends BaseController
{
    protected $pengajarModel;
    protected $statusPengajarModel;
    protected $validation;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->statusPengajarModel = new StatusPengajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        // dd(session()->get('mitra_pengajar_id'));

        $data_pengajar = $this->pengajarModel->getMitraPengajarWithId(session()->get('mitra_pengajar_id'));


        $data = [
            'title' => 'Mitra Pengajar',
            'status_pengajar' => $this->statusPengajarModel->getStatusPengajar(),
            'data_pengajar' => $data_pengajar,
        ];

        return view('mitra/pengajar_v', $data);
    }

    public function view($email)
    {
        if ($email == null) {
            return redirect()->to('/admin/data_pengajar');
        }

        $mitra_pengajar = $this->pengajarModel->getMitraPengajar($email);

        if ($mitra_pengajar == null) {
            return redirect()->to('/admin/data_pengajar');
        }

        $data = [
            'title' => 'Detail Mitra Pengajar',
            'mitra_pengajar' => $mitra_pengajar,
        ];

        return view('mitra/users_profil_v', $data);
    }
}
