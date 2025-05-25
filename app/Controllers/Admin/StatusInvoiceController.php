<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\StatusInvoiceModel;
use CodeIgniter\HTTP\ResponseInterface;

class StatusInvoiceController extends BaseController
{
    protected $statusInvoiceModel;
    protected $validation;

    public function __construct()
    {
        $this->statusInvoiceModel = new StatusInvoiceModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Status Invoice',
            'status_invoice' => $this->statusInvoiceModel->getStatusInvoice()

        ];
        return view('admin/status_invoice_v', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'status_invoice' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Invoice Tidak Boleh Kosong!'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'status_invoice' => $this->validation->getError('status_invoice'),
                    ]
                ];
            } else {

                $status_invoice = $this->request->getPost('status_invoice');

                $this->statusInvoiceModel->save([
                    'status_invoice' => strtolower($status_invoice),

                ]);

                $alert = [
                    'success' => 'Status Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $status_invoice = $this->statusInvoiceModel->where(["id" => $id])->first();

            return json_encode($status_invoice);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'status_invoice' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Invoice Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'status_invoice' => $this->validation->getError('status_invoice'),

                    ]
                ];
            } else {
                $id = $this->request->getPost('id');

                $status_invoice = $this->request->getPost('status_invoice');

                $this->statusInvoiceModel->update($id, [
                    'status_invoice' => $status_invoice,
                ]);

                $alert = [
                    'success' => 'Status Invoice Berhasil di Ubah!'
                ];
            }

            return json_encode($alert);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $status_invoice = $this->statusInvoiceModel->where(["id" => $id])->first();

            $this->statusInvoiceModel->delete($status_invoice["id"]);

            $alert = [
                'success' => 'Status Invoice Berhasil diHapus!'
            ];

            return json_encode($alert);
        }
    }
}
