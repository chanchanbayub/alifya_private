<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Admin\KategoriAPRModel;
use App\Models\Admin\PembimbingModel;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\SkalaNilaiAPRModel;
use App\Models\Mitra\KelompokBelajarModel;
use App\Models\Mitra\KuisionerProgresAnakModel;
use CodeIgniter\HTTP\ResponseInterface;

class KuisionerProgresAnakController extends BaseController
{
    protected $pengajarModel;
    protected $pembimbingModel;
    protected $katagoriAprModel;
    protected $skalaNilaiAprModel;

    protected $kuisionerProgresAnakModel;
    protected $kelompokBelajarModel;

    protected $validation;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->pembimbingModel = new PembimbingModel();
        $this->katagoriAprModel = new KategoriAPRModel();
        $this->skalaNilaiAprModel = new SkalaNilaiAPRModel();

        $this->kuisionerProgresAnakModel = new KuisionerProgresAnakModel();
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->validation = \Config\Services::validation();
        helper(['format']);
    }

    public function index()
    {
        $session_mitra = session('mitra_pengajar_id');

        $pembimbing = $this->pembimbingModel->getPembimbingWhereMitraId($session_mitra);
        $mitra_pengajar = $this->pengajarModel->getDataPengajarStatusAktif();
        $progres_anak = $this->skalaNilaiAprModel->getSkalaNilaiWhereKategori(5);
        $kuisioner_progres = $this->kuisionerProgresAnakModel->getKuisioner();
        // dd($kuisioner_progres);

        $data_kuisioner = [];

        foreach ($kuisioner_progres as $kuisioner) {

            $bobot_kategori = $this->katagoriAprModel->where(["id" => $kuisioner->kategori_apr_id])->first();

            // $bobot_progress = intval($bobot_kategori["bobot_nilai_apr"]) * intval($kuisioner->bobot) / 100;
            // dd($bobot_progress);

            $data_kuisioner[] = [
                'pembimbing' => $pembimbing->nama_lengkap,
                'nama_lengkap' => $kuisioner->nama_lengkap,
                'bulan' => bulan($kuisioner->bulan),
                'tahun' => $kuisioner->tahun,
                'peserta_didik' => $kuisioner->nama_lengkap_anak,
                'progres_anak' => $kuisioner->bobot,

            ];
        }

        if ($pembimbing != null) {
            $data = [
                'title' => 'Kuisioner Progres Peserta Didik',
                'pembimbing' => $pembimbing,
                'mitra' => $mitra_pengajar,
                'progres_anak' => $progres_anak,
                'kuisioner' => $data_kuisioner
            ];

            return view('mitra/kuisioner_progres_anak_v', $data);
        } else {
            return redirect()->back();
        }
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
                'peserta_didik_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong !',
                    ]
                ],
                'progres_anak' => [
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
                        'peserta_didik_id' => $this->validation->getError('peserta_didik_id'),
                        'progres_anak' => $this->validation->getError('progres_anak'),
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

                $peserta_didik_id = $this->request->getPost('peserta_didik_id');
                $progres_anak = $this->request->getPost('progres_anak');

                $cek_kuisioner = $this->kuisionerProgresAnakModel->cekDataKuisioner($pembimbing_id, $mitra_pengajar_id, $peserta_didik_id, $month, $tahun);

                if ($cek_kuisioner == null) {
                    $this->kuisionerProgresAnakModel->save([
                        'pembimbing_id' => strtolower($pembimbing_id),
                        'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                        'peserta_didik_id' => strtolower($peserta_didik_id),
                        'progres_anak' => strtolower($progres_anak),
                        // 'kreativitas' => strtolower($kreativitas),
                        'bulan' => strtolower($month),
                        'tahun' => strtolower($tahun),
                    ]);

                    $alert = [
                        'success' => 'Kuisioner Progres Anak Berhasil di Simpan !'
                    ];
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
