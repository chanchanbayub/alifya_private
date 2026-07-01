<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Admin\PembimbingModel;
use App\Models\Mitra\MuridModel;
use App\Models\Mitra\PengajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class KuisionerController extends BaseController
{
    protected $pengajarModel;
    protected $pembimbingModel;
    protected $validation;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->pembimbingModel = new PembimbingModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $session_mitra = session('mitra_pengajar_id');

        $pembimbing = $this->pembimbingModel->where(["mitra_pengajar_id" => $session_mitra])->first();

        if ($pembimbing != null) {
            $data = [
                'title' => 'Kuisioner Alifya Performance Rangking',
            ];

            return view('mitra/kuisioner_v', $data);
        } else {
            return redirect()->back();
        }
    }
}
