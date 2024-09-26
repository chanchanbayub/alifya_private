<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HargaModel;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KelompokModel;
use App\Models\Admin\MediaBelajarModel;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class InvoiceMitraController extends BaseController
{
    protected $presensiModel;
    protected $kelompokModel;
    protected $pengajarModel;
    protected $kelompokBelajarModel;
    protected $hargaModel;
    protected $validation;
    protected $mediaBelajarModel;

    public function __construct()
    {
        $this->presensiModel = new PresensiModel();
        $this->kelompokModel = new KelompokModel();
        $this->pengajarModel = new PengajarModel();
        $this->hargaModel = new HargaModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->validation = \Config\Services::validation();
        $this->mediaBelajarModel = new MediaBelajarModel();
    }

    public function index()
    {
        $mitra_pengajar = $this->kelompokModel->getKelompokPengajar();


        $data = [
            'title' => 'Invoice Mitra Pengajar',
            'mitra_pengajar' => $mitra_pengajar,

        ];

        return view('admin/invoice_mitra_v', $data);
    }

    public function getPesertaDidik()
    {
        if ($this->request->isAJAX()) {

            $mitra_pengajar_id = $this->request->getVar('mitra_pengajar_id');

            $peserta_didik = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajar($mitra_pengajar_id);

            $data = [
                'peserta_didik' => $peserta_didik
            ];

            return json_encode($data);
        }
    }

    public function cek_invoice()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !'
                    ]
                ],

                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan Tidak Boleh Kosong !'
                    ]
                ],
                'harga_media' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'bulan' => $this->validation->getError('bulan'),
                        'harga_media' => $this->validation->getError('harga_media'),

                    ]
                ];
            } else {

                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $bulan_media = $this->request->getPost('bulan');
                $harga_media = $this->request->getPost('harga_media');

                $media_belajar = $this->mediaBelajarModel->getMediaBelajar($mitra_pengajar_id, $bulan_media);

                if ($media_belajar == null) {
                    $this->mediaBelajarModel->save([
                        'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                        'bulan_media' => strtolower($bulan_media),
                        'harga_media' => strtolower($harga_media),
                    ]);
                    $invoice = $this->presensiModel->getPresensiMitraWithMonth($mitra_pengajar_id, $bulan_media);
                    $media_belajar = $this->mediaBelajarModel->getMediaBelajar($mitra_pengajar_id, $bulan_media);
                    $jumlah = count($invoice);
                    $alert = [
                        'media_belajar' => $media_belajar,
                        'jumlah_pertemuan' => $jumlah
                    ];
                } elseif ($media_belajar != null) {
                    if ($media_belajar->harga_media != $harga_media) {
                        $this->mediaBelajarModel->update($media_belajar->id, [
                            'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                            'bulan_media' => strtolower($bulan_media),
                            'harga_media' => strtolower($harga_media),
                        ]);
                    }
                    $invoice = $this->presensiModel->getPresensiMitraWithMonth($mitra_pengajar_id, $bulan_media);
                    $media_belajar = $this->mediaBelajarModel->getMediaBelajar($mitra_pengajar_id, $bulan_media);
                    $jumlah = count($invoice);
                    $alert = [
                        'media_belajar' => $media_belajar,
                        'jumlah_pertemuan' => $jumlah
                    ];
                }
            }

            return json_encode($alert);
        }
    }
}
