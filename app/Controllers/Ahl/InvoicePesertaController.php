<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\LainLainPesertaAHLModel;
use App\Models\Ahl\PesertaDidikAhlModel;
use CodeIgniter\HTTP\ResponseInterface;

class InvoicePesertaController extends BaseController
{

    protected $validation;
    protected $pesertaDidikAhlModel;
    protected $lainLainPesertaAhlModel;
    public function __construct()
    {
        $this->pesertaDidikAhlModel = new PesertaDidikAhlModel();
        $this->lainLainPesertaAhlModel = new LainLainPesertaAHLModel();
        $this->validation = \Config\Services::validation();

        helper(['format']);
    }


    public function index()
    {
        $data = [
            'title' => 'Invoice Peserta Didik AHL',
            'peserta_didik' => $this->pesertaDidikAhlModel->getPesertaDidikAhl()
        ];

        return view('ahl/invoice_peserta_ahl_v', $data);
    }

    public function cek_invoice()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'bulan' => $this->validation->getError('bulan'),
                    ]
                ];
            } else {
                helper(['format']);

                $bulan = $this->request->getVar('bulan');

                $data_bulan = explode("-", $bulan);

                $inputan_bulan = intval($data_bulan[1]);
                $inputan_tahun = intval($data_bulan[0]);

                $peserta_ahl = $this->pesertaDidikAhlModel->getPesertaDidikAhlInvoice();

                $peserta_didik = [];

                foreach ($peserta_ahl as $data) {

                    $lain_lain = $this->lainLainPesertaAhlModel->where(["peserta_didik_ahl_id" => $data->id])->where(["bulan" => $inputan_bulan])->where(["tahun" => $inputan_tahun])->get()->getRowObject();
                    // dd($lain_lain->lain_lain);

                    $peserta_didik[] = [
                        'id' => $data->id,
                        'nama_lengkap_anak' => $data->nama_lengkap_anak,
                        'nama_program' => $data->nama_program,
                        'harga_paket' => $data->harga_paket,
                        'lain_lain' => $lain_lain->lain_lain,
                        'total_akhir' => intval($data->harga_paket) + intval($lain_lain->lain_lain)
                    ];
                }

                $alert = [
                    'peserta_didik_ahl' => $peserta_didik,
                    'bulan' => $inputan_bulan,
                    'tahun' => $inputan_tahun,
                    'total' => $this->pesertaDidikAhlModel->getTotalInvoice(),
                ];
            }
            return json_encode($alert);
        }
    }
}
