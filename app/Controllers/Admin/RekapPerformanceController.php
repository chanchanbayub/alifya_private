<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KategoriAPRModel;
use App\Models\Admin\KelompokBelajarModel;
use App\Models\Admin\KuisionerKreativitasModel;
use App\Models\Admin\KuisionerModel;
use App\Models\Admin\KuisionerProgresAnakModel;
use App\Models\Admin\PembimbingModel;
use App\Models\Admin\PengajarModel;
use App\Models\Admin\PresensiModel;
use App\Models\Admin\SkalaNilaiAPRModel;
use App\Models\Admin\StandarPredikatAPRModel;
use CodeIgniter\HTTP\ResponseInterface;

class RekapPerformanceController extends BaseController
{
    protected $pengajarModel;
    protected $pembimbingModel;
    protected $katagoriAprModel;
    protected $skalaNilaiAprModel;
    protected $kuisionerModel;
    protected $presensiModel;
    protected $kelompokBelajarModel;
    protected $kuisionerKreativitasModel;
    protected $kuisionerProgressAnakModel;
    protected $standarPredikatAprModel;

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
        $this->kuisionerProgressAnakModel = new KuisionerProgresAnakModel();
        $this->validation = \Config\Services::validation();
        $this->standarPredikatAprModel = new StandarPredikatAPRModel();

        helper(['format']);
    }

    public function index()
    {
        $data = [
            'title' => 'Penilaian Alifya Performance Rangking',
        ];

        return view('admin/rekap_apr', $data);
    }

    public function cek_penilaian()
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

                $perhitungan_murid = $this->skalaNilaiAprModel->getSkalaNilaiWhereKategori(1);
                $perhitungan_kehadiran = $this->skalaNilaiAprModel->getSkalaNilaiWhereKategori(4);



                $bulan = $this->request->getVar('bulan');

                $data_bulan = explode("-", $bulan);

                $inputan_bulan = intval($data_bulan[1]);
                $inputan_tahun = intval($data_bulan[0]);

                $kuisioner = $this->kuisionerModel->getRekapKuisionerPerbulan($inputan_bulan, $inputan_tahun);

                $data_kuisioner = [];

                foreach ($kuisioner as $kuisioner) {

                    $pembimbing_data = $this->pembimbingModel->getPembimbingWherePembimbingId($kuisioner->pembimbing_id);
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

                    // Progress Siswa
                    $rata_rata_progres = $this->kuisionerProgressAnakModel->getRataRata($kuisioner->pembimbing_id, $kuisioner->mitra_pengajar_id, $kuisioner->bulan, $kuisioner->tahun);

                    $jumlah_data_progress = count($this->kuisionerProgressAnakModel->getJumlahData($kuisioner->pembimbing_id, $kuisioner->mitra_pengajar_id, $kuisioner->bulan, $kuisioner->tahun));

                    $progres_anak = intval($rata_rata_progres->total_bobot) / intval($jumlah_data_progress);
                    $bobot_progres_anak = $this->katagoriAprModel->where(["id" => 5])->first();

                    $nilai_progress_anak = intval($bobot_progres_anak["bobot_nilai_apr"]) * intval($progres_anak) / 100;

                    $final_score = intval($kuisioner_jumlah_murid) + intval($kuisioner_administrasi) + intval($kuisioner_kreativitas) + intval($kehadiran_jumlah) + intval($nilai_progress_anak);

                    $predikat = $this->standarPredikatAprModel->getStandarPredikat();
                    // dd($final_score);
                    foreach ($predikat as $predikat) {

                        if ($final_score >= $predikat->nilai_predikat && $final_score <= $predikat->nilai_akhir) {
                            $nilai = $predikat->predikat;
                        };
                        // dd($nilai);
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
                        'progres_anak' => $nilai_progress_anak,
                        'final_score' => $final_score,
                        'nilai_data' => $nilai

                    ];
                };




                $alert = [
                    'inputan_bulan' => $inputan_bulan,
                    'inputan_tahun' => $inputan_tahun,
                    'data_kuisioner' => $data_kuisioner
                ];
            }
        }
        return json_encode($alert);
    }
}
