<?php

namespace App\Controllers\Ahl;

use App\Controllers\BaseController;
use App\Models\Ahl\PesertaDidikAhlModel;
use CodeIgniter\HTTP\ResponseInterface;

class InvoicePesertaController extends BaseController
{

    protected $validation;
    protected $pesertaDidikAhlModel;

    public function __construct()
    {
        $this->pesertaDidikAhlModel = new PesertaDidikAhlModel();
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

                $alert = [
                    'peserta_didik_ahl' => $this->pesertaDidikAhlModel->getPesertaDidikAhlInvoice(),
                    'bulan' => $inputan_bulan,
                    'tahun' => $inputan_tahun,
                    'total' => $this->pesertaDidikAhlModel->getTotalInvoice(),
                ];
            }
            return json_encode($alert);
        }
    }
}
