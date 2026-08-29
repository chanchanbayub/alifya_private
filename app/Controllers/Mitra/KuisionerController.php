<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Admin\KategoriAPRModel;
use App\Models\Admin\PembimbingModel;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\SkalaNilaiAPRModel;
use App\Models\Mitra\KuisionerKreativitasModel;
use App\Models\Mitra\KuisionerModel;
use App\Models\Mitra\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class KuisionerController extends BaseController
{
    protected $pengajarModel;
    protected $pembimbingModel;
    protected $katagoriAprModel;
    protected $skalaNilaiAprModel;
    protected $kuisionerModel;
    protected $presensiModel;
    protected $kuisionerKreativitasModel;
    protected $validation;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->pembimbingModel = new PembimbingModel();
        $this->katagoriAprModel = new KategoriAPRModel();
        $this->skalaNilaiAprModel = new SkalaNilaiAPRModel();
        $this->kuisionerModel = new KuisionerModel();
        $this->kuisionerKreativitasModel = new KuisionerKreativitasModel();
        $this->presensiModel = new PresensiModel();
        $this->validation = \Config\Services::validation();
        helper(['format']);
    }

    public function index()
    {
        $session_mitra = session('mitra_pengajar_id');

        $pembimbing = $this->pembimbingModel->getPembimbingWhereMitraId($session_mitra);
        $mitra_pengajar = $this->pengajarModel->getDataPengajarStatusAktif();
        $kreativitas = $this->skalaNilaiAprModel->getSkalaNilaiWhereKategori(3);
        $administrasi = $this->skalaNilaiAprModel->getSkalaNilaiWhereKategori(2);
        $kuisioner = $this->kuisionerModel->getKuisioner();
        // dd($kuisioner);

        $data_kuisioner = [];

        foreach ($kuisioner as $kuisioner) {

            $kuisioner_kreativitas = $this->kuisionerKreativitasModel->getKuisionerKreativitas($kuisioner->pembimbing_id, $kuisioner->mitra_pengajar_id, $kuisioner->bulan, $kuisioner->tahun);
            // dd($kuisioner_kreativitas);

            $data_kuisioner[] = [
                'pembimbing' => $pembimbing->nama_lengkap,
                'nama_lengkap' => $kuisioner->nama_lengkap,
                'bulan' => bulan($kuisioner->bulan),
                'tahun' => $kuisioner->tahun,
                'administrasi' => $kuisioner->administrasi,
                'kreativitas' => $kuisioner_kreativitas->kreativitas,
                'jumlah_murid_aktif' => $kuisioner->jumlah_murid_aktif
            ];
        };
        // dd($kuisioner);

        if ($pembimbing != null) {
            $data = [
                'title' => 'Kuisioner Alifya Performance Rangking',
                'pembimbing' => $pembimbing,
                'mitra' => $mitra_pengajar,
                'administrasi' => $administrasi,
                'kreativitas' => $kreativitas,
                'kuisioner' => $data_kuisioner
            ];

            return view('mitra/kuisioner_v', $data);
        } else {
            return redirect()->back();
        }
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'pembimbing_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !'
                    ]
                ],
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !',
                    ]
                ],
                'administrasi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !',
                    ]
                ],
                'kreativitas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !',
                    ]
                ],
                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !',
                    ]
                ],


            ])) {
                $alert = [
                    'error' => [
                        'pembimbing_id' => $this->validation->getError('pembimbing_id'),
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'administrasi' => $this->validation->getError('administrasi'),
                        'kreativitas' => $this->validation->getError('kreativitas'),
                        'bulan' => $this->validation->getError('bulan'),
                    ]
                ];
            } else {

                $pembimbing_id = $this->request->getPost('pembimbing_id');
                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');

                $bulan = $this->request->getPost('bulan');
                $bulan_data = explode("-", $bulan);
                $month = $bulan_data["1"];
                $tahun = $bulan_data["0"];

                $administrasi = $this->request->getPost('administrasi');

                $kreativitas = $this->request->getPost('kreativitas');

                $jumlah_murid_aktif = $this->presensiModel->SumTotalAnak($mitra_pengajar_id, $month, $tahun);

                $cek_kuisioner = $this->kuisionerModel->cekDataKuisioner($pembimbing_id, $mitra_pengajar_id, $month, $tahun);
                // dd($cek_kuisioner);


                if ($cek_kuisioner == null) {

                    $cek_kuisioner_kreativitas = $this->kuisionerKreativitasModel->getKuisionerKreativitas($pembimbing_id, $mitra_pengajar_id, $month, $tahun);

                    if ($cek_kuisioner_kreativitas == null) {

                        $this->kuisionerKreativitasModel->save([
                            'pembimbing_id' => strtolower($pembimbing_id),
                            'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                            'kreativitas' => strtolower($kreativitas),
                            // 'kreativitas' => strtolower($kreativitas),
                            'bulan' => strtolower($month),
                            'tahun' => strtolower($tahun),
                        ]);
                        $this->kuisionerModel->save([
                            'pembimbing_id' => strtolower($pembimbing_id),
                            'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                            'administrasi' => strtolower($administrasi),
                            // 'kreativitas' => strtolower($kreativitas),
                            'bulan' => strtolower($month),
                            'tahun' => strtolower($tahun),
                            'jumlah_murid_aktif' => intval($jumlah_murid_aktif->total_anak),

                        ]);

                        $alert = [
                            'success' => 'Kuisioner Pertama Berhasil di Simpan !'
                        ];
                    } else {
                        $alert = [
                            'duplikat' => 'Kuisioner dengan Mitra tersebut, dan bulan tersebut sudah terdaftar'
                        ];
                    }
                } else {
                    $alert = [
                        'duplikat' => 'Kuisioner dengan Mitra tersebut, dan bulan tersebut sudah terdaftar'
                    ];
                }
            }

            return json_encode($alert);
        }
    }
}
