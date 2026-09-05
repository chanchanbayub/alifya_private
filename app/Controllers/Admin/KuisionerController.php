<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KategoriAPRModel;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KuisionerKreativitasModel;
use App\Models\Admin\KuisionerModel;
use App\Models\Admin\PembimbingModel;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\PresensiModel;
use App\Models\Admin\SkalaNilaiAPRModel;
use CodeIgniter\HTTP\ResponseInterface;

class KuisionerController extends BaseController
{
    protected $pengajarModel;
    protected $pembimbingModel;
    protected $katagoriAprModel;
    protected $skalaNilaiAprModel;
    protected $kuisionerModel;
    protected $presensiModel;
    protected $kelompokBelajarModel;
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
        $this->kelompokBelajarModel = new KelompokBelajarModel();
        $this->validation = \Config\Services::validation();
        helper(['format']);
    }

    public function index()
    {


        $pembimbing = $this->pembimbingModel->getPembimbing();
        $mitra_pengajar = $this->pengajarModel->getDataPengajarStatusAktif();
        $kreativitas = $this->skalaNilaiAprModel->getSkalaNilaiWhereKategori(3);
        $administrasi = $this->skalaNilaiAprModel->getSkalaNilaiWhereKategori(2);
        $perhitungan_murid = $this->skalaNilaiAprModel->getSkalaNilaiWhereKategori(1);
        $perhitungan_kehadiran = $this->skalaNilaiAprModel->getSkalaNilaiWhereKategori(4);
        // dd($perhitungan_murid);
        $kuisioner = $this->kuisionerModel->getKuisioner();
        // dd($kuisioner);

        $data_kuisioner = [];

        foreach ($kuisioner as $kuisioner) {

            // dd($kuisioner->pembimbing_id);
            $pembimbing_data = $this->pembimbingModel->getPembimbingWherePembimbingId($kuisioner->pembimbing_id);
            // dd($pembimbing_data);
            // Kreativitas
            $kuisioner_kreativitas = $this->kuisionerKreativitasModel->getKuisionerKreativitas($kuisioner->pembimbing_id, $kuisioner->mitra_pengajar_id, $kuisioner->bulan, $kuisioner->tahun);

            $bobot_kategori = $this->katagoriAprModel->where(["id" => $kuisioner->kategori_apr_id])->first();
            $bobot_kategori_kreativitas = $this->katagoriAprModel->where(["id" => $kuisioner_kreativitas->kategori_apr_id])->first();

            $kuisioner_administrasi = intval($bobot_kategori["bobot_nilai_apr"]) * intval($kuisioner->administrasi) / 100;
            $kuisioner_kreativitas = intval($bobot_kategori_kreativitas["bobot_nilai_apr"]) * intval($kuisioner_kreativitas->kreativitas) / 100;

            $bobot_jumlah_anak =  $this->katagoriAprModel->where(["id" => 1])->first();

            foreach ($perhitungan_murid as $jumlah) {
                if ($kuisioner->jumlah_murid_aktif >= $jumlah->nilai_awal && $kuisioner->jumlah_murid_aktif <= $jumlah->nilai_akhir) {
                    $kuisioner_jumlah_murid = intval($bobot_jumlah_anak["bobot_nilai_apr"]) * intval($jumlah->bobot) / 100;
                };
            }

            $bobot_kehadiran =  $this->katagoriAprModel->where(["id" => 4])->first();

            foreach ($perhitungan_kehadiran as $jumlah_perhitungan) {
                if ($kuisioner->kehadiran >= $jumlah_perhitungan->nilai_awal && $kuisioner->kehadiran <= $jumlah_perhitungan->nilai_akhir) {
                    $kehadiran_jumlah = intval($bobot_kehadiran["bobot_nilai_apr"]) * intval($jumlah_perhitungan->bobot) / 100;
                };
            }


            $data_kuisioner[] = [
                'id' => $kuisioner->id,
                'pembimbing_data' => $pembimbing_data->nama_lengkap,
                'nama_lengkap' => $kuisioner->nama_lengkap,
                'bulan' => bulan($kuisioner->bulan),
                'tahun' => $kuisioner->tahun,
                'administrasi' => $kuisioner_administrasi,
                'kreativitas' => $kuisioner_kreativitas,
                'jumlah_murid_aktif' => $kuisioner_jumlah_murid,
                'kehadiran' => $kehadiran_jumlah,
                // 'pembimbing' => $pembimbing,
            ];
        };
        // dd($kuisioner);
        // dd($data_kuisioner);

        if ($pembimbing != null) {
            $data = [
                'title' => 'Kuisioner Alifya Performance Rangking',
                'pembimbing' => $pembimbing,
                'mitra' => $mitra_pengajar,
                'administrasi' => $administrasi,
                'kreativitas' => $kreativitas,
                'kuisioner' => $data_kuisioner

            ];

            return view('admin/kuisioner_v', $data);
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

                $kehadiran = $this->presensiModel->getPresensiPerMitra($mitra_pengajar_id, $month, $tahun);

                $jumlah_paket_belajar = $this->kelompokBelajarModel->getPesertaDidikWhereMitraPengajarSumPaketBelajar($mitra_pengajar_id);
                // dd()

                if (count($kehadiran) > 0) {
                    $presensi_ideal = number_format(intval(count($kehadiran)) / intval($jumlah_paket_belajar->total_paket_belajar) * 100);
                } else {
                    $presensi_ideal = 0;
                }

                $jumlah_murid_aktif = $this->presensiModel->getJumlahMuridAktif($mitra_pengajar_id, $month, $tahun);
                // dd($jumlah_murid_aktif->total_anak);

                $cek_kuisioner = $this->kuisionerModel->cekDataKuisioner($pembimbing_id, $mitra_pengajar_id, $month, $tahun);

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
                            'kehadiran' => $presensi_ideal,
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

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kuisioner_rangking = $this->kuisionerModel->where(["id" => $id])->first();

            $data = [
                'kuisioner_rangking' => $kuisioner_rangking,
            ];

            return json_encode($data);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $kuisioner = $this->kuisionerModel->where(["id" => $id])->first();
            $kuisioner_kreativitas = $this->kuisionerKreativitasModel->where(["pembimbing_id" => $kuisioner["pembimbing_id"]])->where(["mitra_pengajar_id" => $kuisioner["mitra_pengajar_id"]])->where(["bulan" => $kuisioner["bulan"]])->where(["tahun" => $kuisioner["tahun"]])->first();

            $this->kuisionerKreativitasModel->delete($kuisioner_kreativitas["id"]);

            $this->kuisionerModel->delete($kuisioner["id"]);

            $alert = [
                'success' => 'Kuisioner Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }
}
