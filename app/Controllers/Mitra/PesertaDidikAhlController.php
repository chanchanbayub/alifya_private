<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Admin\StatusMuridModel;
use App\Models\Ahl\PesertaDidikAhlModel;
use App\Models\Ahl\PriceListModel;
use App\Models\Ahl\ProgramAHLModel;
use App\Models\Ahl\TingkatPendidikanModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class PesertaDidikAhlController extends BaseController
{
    protected $pesertaDidikAhlModel;
    protected $programAhlModel;
    protected $tingkatPendidikanModel;
    protected $statusMuridModel;
    protected $priceListModel;
    protected $validation;

    public function __construct()
    {
        $this->pesertaDidikAhlModel = new PesertaDidikAhlModel();
        $this->programAhlModel = new ProgramAHLModel();
        $this->tingkatPendidikanModel = new TingkatPendidikanModel();
        $this->statusMuridModel = new StatusMuridModel();
        $this->priceListModel = new PriceListModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Peserta Didik Alifya Home Learning',
            'program_ahl' => $this->programAhlModel->getProgramAHL(),
            'pendidikan' => $this->tingkatPendidikanModel->getPendidikan(),
            'price_list' => $this->priceListModel->getPriceList(),
            'status_murid' => $this->statusMuridModel->getStatusMurid()
        ];

        return view('mitra/peserta_ahl_v', $data);
    }

    public function getPesertaAhl()
    {
        if ($this->request->isAjax()) {
            $peserta_didik_ahl = $this->pesertaDidikAhlModel->getPesertaAhl();

            return DataTable::of($peserta_didik_ahl)

                ->add('lihat_profil', function ($row) {
                    return '<a href="/mitra_pengajar/peserta_ahl/getProfil/' .  $row->id . '" class="btn btn-sm btn-outline-primary" target="_blank" >
                                                    <i class="bi bi-eye"></i> Lihat Profil
                                                </a>
                           ';
                })
                ->setSearchableColumns(['nama_lengkap_anak'])
                ->addNumbering('no')->toJson(true);
        }
    }

    public function getProfil($id)
    {
        if ($id == null) {
            dd($id);
            return redirect()->to('/admin/data_murid');
        }

        $profil = $this->pesertaDidikAhlModel->getProfil($id);
        // dd($profil);
        $hari_ini = date_create();
        $tanggal_lahir = date_create($profil->tanggal_lahir_anak);

        $usia = date_diff($hari_ini, $tanggal_lahir);

        if ($profil == null) {
            return redirect()->to('/admin/data_murid');
        }

        $data = [
            'title' => 'Profil Peserta Didik AHL',
            'profil' => $profil,
            'usia' => $usia
        ];

        return view('mitra/profil_ahl_v', $data);
    }
}
