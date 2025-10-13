<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Admin\HargaModel;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KelompokModel;
use App\Models\Admin\KlaimMediaPesertaModel;
use App\Models\Admin\MuridModel;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class InvoiceController extends BaseController
{
    protected $presensiModel;
    protected $kelompokModel;
    protected $pengajarModel;
    protected $kelompokBelajarModel;
    protected $klaimMediaPesertaModel;
    protected $muridModel;
    protected $hargaModel;
    protected $validation;

    public function __construct()
    {
        $this->presensiModel = new PresensiModel();
        $this->kelompokModel = new KelompokModel();
        $this->pengajarModel = new PengajarModel();
        $this->hargaModel = new HargaModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->muridModel = new MuridModel();
        $this->klaimMediaPesertaModel = new KlaimMediaPesertaModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        helper(['format']);

        $bulan = date('n');
        // dd($bulan);

        $tahun = date('Y');
        // dd($tahun);

        $peserta_didik = $this->kelompokBelajarModel->getKelompokBelajar();


        $data_presensi = [];
        foreach ($peserta_didik as $data_anak) {

            $presensi_data = $this->presensiModel->getPresensiPerAnak($data_anak->peserta_didik_id, $bulan, $tahun);
            // dd($presensi_data);
            foreach ($presensi_data as $data_peserta) {

                if ($data_peserta->harga == null) {
                    $harga = 0;
                } else {
                    $harga = $data_peserta->harga;
                }

                if ($data_peserta->harga_media == null) {
                    $harga_media = 0;
                } else {
                    $harga_media  = $data_peserta->harga_media;
                }

                if ($data_peserta->lain_lain == null) {
                    $lain_lain = 0;
                } else {
                    $lain_lain  = $data_peserta->lain_lain;
                }

                if ($data_peserta->total_presensi_perbulan == null) {
                    $total_presensi_perbulan = 0;
                } else {
                    $total_presensi_perbulan  = $data_peserta->total_presensi_perbulan;
                }

                $data_presensi[] = [
                    'id' => $data_peserta->id,
                    'mitra_pengajar_id' => $data_peserta->mitra_pengajar_id,
                    'bulan' => $data_peserta->bulan,
                    'nama_lengkap' => $data_peserta->nama_lengkap,
                    'nama_lengkap_anak' => $data_peserta->nama_lengkap_anak,
                    'total_presensi_perbulan' => intval($total_presensi_perbulan),
                    'harga' =>  intval($harga),
                    'jumlah_upah' => intval($harga) * intval($total_presensi_perbulan),
                    'media_belajar' => intval($harga_media),
                    'lain_lain' => intval($lain_lain),
                    'total_akhir' => intval($total_presensi_perbulan) * intval($harga) + intval($harga_media) + intval($lain_lain)
                ];
            }
        }

        // dd($data_presensi);

        $total_harga = $this->presensiModel->SumHargaPresensi($bulan, $tahun);
        $total_harga_media = $this->klaimMediaPesertaModel->SumHargaMedia($bulan, $tahun);

        // dd($total_harga_media);

        if ($total_harga->total_harga == null) {
            $total_bayar = "0";
        } else {
            $total_bayar = $total_harga->total_harga;
        }

        if ($total_harga_media->total_harga_media == null) {
            $total_media = "0";
        } else {
            $total_media = $total_harga_media->total_harga_media;
        }

        if ($total_harga_media->total_lain_lain == null) {
            $total_lain_lain = "0";
        } else {
            $total_lain_lain = $total_harga_media->total_lain_lain;
        }

        $total_pemasukan = intval($total_bayar) + intval($total_media) + intval($total_lain_lain);
        // dd($total_pemasukan);

        $data = [
            'data_presensi' => $data_presensi,
            'title' => 'Invoice Peserta Didik',
            'total_pemasukan' => $total_pemasukan,
            'jumlah_data_presensi' => count($data_presensi)
        ];

        return view('admin/invoice_v', $data);
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

    public function getHargaPeserta()
    {
        if ($this->request->isAJAX()) {

            $peserta_didik_id = $this->request->getVar('peserta_didik_id');

            $harga_perjam = $this->hargaModel->where(["peserta_didik_id" => $peserta_didik_id])->get()->getRowObject();

            $data = [
                'harga_perjam' => $harga_perjam
            ];

            return json_encode($data);
        }
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

                $peserta_didik = $this->kelompokBelajarModel->getKelompokBelajar();

                $data_presensi = [];
                foreach ($peserta_didik as $data_anak) {

                    $presensi_data = $this->presensiModel->getPresensiPerAnak($data_anak->peserta_didik_id, $inputan_bulan, $inputan_tahun);

                    foreach ($presensi_data as $data_peserta) {

                        if ($data_peserta->harga == null) {
                            $harga = 0;
                        } else {
                            $harga = $data_peserta->harga;
                        }

                        if ($data_peserta->harga_media == null) {
                            $harga_media = 0;
                        } else {
                            $harga_media  = $data_peserta->harga_media;
                        }

                        if ($data_peserta->lain_lain == null) {
                            $lain_lain = 0;
                        } else {
                            $lain_lain  = $data_peserta->lain_lain;
                        }

                        if ($data_peserta->total_presensi_perbulan == null) {
                            $total_presensi_perbulan = 0;
                        } else {
                            $total_presensi_perbulan  = $data_peserta->total_presensi_perbulan;
                        }

                        $data_presensi[] = [
                            'id' => $data_peserta->id,
                            'mitra_pengajar_id' => $data_anak->mitra_pengajar_id,
                            'bulan' => $data_peserta->bulan,
                            'nama_lengkap' => $data_anak->nama_lengkap,
                            'nama_lengkap_anak' => $data_anak->nama_lengkap_anak,
                            'total_presensi_perbulan' => intval($total_presensi_perbulan),
                            'harga' =>  intval($harga),
                            'jumlah_upah' => intval($harga) * intval($total_presensi_perbulan),
                            'media_belajar' => intval($harga_media),
                            'lain_lain' => intval($lain_lain),
                            'total_akhir' => intval($total_presensi_perbulan) * intval($harga) + intval($harga_media) + intval($lain_lain)
                        ];
                    }
                }

                $total_data = $this->presensiModel->sumTotalAnak($inputan_bulan, $inputan_tahun);
                $total_harga = $this->presensiModel->SumHargaPresensi($inputan_bulan, $inputan_tahun);
                $total_harga_media = $this->klaimMediaPesertaModel->SumHargaMedia($inputan_bulan, $inputan_tahun);


                if ($total_harga->total_harga == null) {
                    $total_bayar = "0";
                } else {
                    $total_bayar = $total_harga->total_harga;
                }

                if ($total_harga_media->total_harga_media == null) {
                    $total_media = "0";
                } else {
                    $total_media = $total_harga_media->total_harga_media;
                }

                if ($total_harga_media->total_lain_lain == null) {
                    $total_lain_lain = "0";
                } else {
                    $total_lain_lain = $total_harga_media->total_lain_lain;
                }

                if ($total_data->total_presensi_perbulan == null) {
                    $total_presensi_perbulan = intval(0);
                } else {
                    $total_presensi_perbulan = intval($total_data->total_presensi_perbulan);
                }

                $total_pemasukan =  $total_bayar + $total_media + $total_lain_lain;

                $alert = [
                    'data_presensi' => $data_presensi,
                    'total_pemasukan' => $total_pemasukan,
                    'total_presensi_perbulan' => $total_presensi_perbulan
                ];
            }
        }
        return json_encode($alert);
    }
}
