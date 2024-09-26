<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\Admin\PaketBelajarModel;
use App\Models\Admin\ProgramBelajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProgramBelajarController extends BaseController
{
    protected $programBelajarModel;
    protected $paketBelajarModel;
    protected $validation;

    public function __construct()
    {
        $this->programBelajarModel = new ProgramBelajarModel();
        $this->paketBelajarModel = new PaketBelajarModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Program Belajar',
            'program_belajar' => $this->programBelajarModel->getProgramBelajar(),
            'paket_belajar' => $this->paketBelajarModel->getPaketBelajar()
        ];

        return view('users/program_belajar_v', $data);
    }
}
