<?php

namespace App\Controllers\Mitra;

use App\Controllers\BaseController;
use App\Models\Admin\PengajarModel;
use App\Models\AHL\AbsensiAHLModel;
use App\Models\Mitra\AbsensiAHLModel as MitraAbsensiAHLModel;
use CodeIgniter\Exceptions\AlertError;
use CodeIgniter\HTTP\ResponseInterface;

class AbsensiAHLController extends BaseController
{
    protected $pengajarModel;
    protected $validation;
    // protected $kelompokBelajarModel;
    protected $absensiAhlModel;

    public function __construct()
    {
        $this->pengajarModel = new PengajarModel();
        $this->absensiAhlModel = new MitraAbsensiAHLModel();
        $this->validation = \Config\Services::validation();
        // $this->kelompokBelajarModel = new KelompokBelajarModel();

        helper(['format']);
    }

    public function index()
    {

        $mitra_pengajar = $this->pengajarModel->getMitraPengajarWithId(session()->get('mitra_pengajar_id'));

        $data = [
            'title' => 'Absensi Mitra AHL',
            'absensi' => $this->absensiAhlModel->getDataAbsensiAhl($mitra_pengajar->id),
            'mitra_pengajar' => $mitra_pengajar,
        ];

        return view('mitra/absensi_ahl_v', $data);
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
                'tanggal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Tidak Boleh Kosong !'
                    ]
                ],
                'mitra_pengajar_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mitra Pengajar Tidak Boleh Kosong !'
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Upah Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'tanggal' => $this->validation->getError('tanggal'),
                        'mitra_pengajar_id' => $this->validation->getError('mitra_pengajar_id'),
                        'keterangan' => $this->validation->getError('keterangan'),
                    ]
                ];
            } else {

                $tanggal = $this->request->getPost('tanggal');
                $mitra_pengajar_id = $this->request->getPost('mitra_pengajar_id');
                $keterangan = $this->request->getPost('keterangan');

                $cek_data = $this->absensiAhlModel->where(["mitra_pengajar_id" => $mitra_pengajar_id])->where(["tanggal" => $tanggal])->first();
                // dd(count($cek_data));

                if ($cek_data != null) {
                    $alert = [
                        'duplikat' => 'Tanggal sudah tersimpan di database'
                    ];
                } else {
                    $this->absensiAhlModel->save([
                        'tanggal' => strtolower($tanggal),
                        'mitra_pengajar_id' => strtolower($mitra_pengajar_id),
                        'keterangan' => strtolower($keterangan),

                    ]);

                    $alert = [
                        'success' => 'Absensi Berhasil di Simpan !'
                    ];
                }
            }

            return json_encode($alert);
        }
    }
}
