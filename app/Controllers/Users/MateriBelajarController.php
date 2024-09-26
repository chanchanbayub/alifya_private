<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\Admin\MateriBelajarModel;
use App\Models\Admin\ProgramBelajarModel;
use CodeIgniter\HTTP\ResponseInterface;

class MateriBelajarController extends BaseController
{
    protected $programBelajarModel;
    protected $materiBelajarModel;

    public function __construct()
    {
        $this->programBelajarModel = new ProgramBelajarModel();
        $this->materiBelajarModel = new MateriBelajarModel();
    }

    public function index()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');


            $program_belajar = $this->programBelajarModel->where(["id" => $id])->get()->getRowObject();
            $materi_belajar = $this->materiBelajarModel->where(["program_belajar_id" => $id])->get()->getResultObject();

            $data = [
                'materi_belajar' => $materi_belajar,
                'program_belajar' => $program_belajar,
            ];

            return json_encode($data);
        }
    }

    public function getMateriBelajar()
    {

        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('program_belajar_id');

            $materi_belajar = $this->materiBelajarModel->where(["program_belajar_id" => $id])->get()->getResultObject();

            $data = [
                'materi_belajar' => $materi_belajar
            ];

            return json_encode($data);
        }
    }
}
