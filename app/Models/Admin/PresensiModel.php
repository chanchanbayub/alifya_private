<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table            = 'presensi_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['mitra_pengajar_id', 'tanggal_masuk', 'jam_masuk', 'peserta_didik_id', 'dokumentasi', 'dokumentasi_orang_tua'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDataPresensi()
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.tanggal_masuk, presensi_table.jam_masuk, presensi_table.dokumentasi, presensi_table.dokumentasi_orang_tua,data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak")
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->orderBy('presensi_table.tanggal_masuk desc')
            ->get()->getResultObject();
    }

    public function getDataPresensiPerhari($tanggal)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.tanggal_masuk, presensi_table.jam_masuk, presensi_table.dokumentasi,presensi_table.dokumentasi_orang_tua, ,data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak, presensi_table.mitra_pengajar_id")
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->where(["presensi_table.tanggal_masuk" => $tanggal])
            ->orderBy('presensi_table.tanggal_masuk desc')
            ->get()->getResultObject();
    }

    public function getDataPresensiPerbulan($tanggal)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.tanggal_masuk, presensi_table.jam_masuk, presensi_table.dokumentasi,presensi_table.dokumentasi_orang_tua, data_pengajar_table.nama_lengkap, data_murid_table.nama_lengkap_anak")
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->where(["presensi_table.tanggal_masuk" => $tanggal])
            ->orderBy('presensi_table.tanggal_masuk desc')
            ->get()->getResultObject();
    }

    public function getPresensiWithMonth($mitra_pengajar_id, $bulan, $peserta_didik_id)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.mitra_pengajar_id ,presensi_table.tanggal_masuk, presensi_table.jam_masuk,  data_murid_table.nama_lengkap_anak")
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->where(["presensi_table.peserta_didik_id" => $peserta_didik_id])
            ->orderBy('presensi_table.tanggal_masuk asc')
            ->get()->getResultObject();
    }

    public function getPresensiMitraWithMonth($mitra_pengajar_id, $bulan)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.mitra_pengajar_id ,presensi_table.tanggal_masuk, presensi_table.jam_masuk,  data_murid_table.nama_lengkap_anak")
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)

            ->orderBy('presensi_table.tanggal_masuk desc')
            ->get()->getResultObject();
    }

    public function getInvoiceMitraWithMonth($mitra_pengajar_id, $bulan)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.mitra_pengajar_id ,presensi_table.tanggal_masuk, presensi_table.jam_masuk,  data_murid_table.nama_lengkap_anak, harga_mitra_table.harga_mitra, harga_mitra_table.booster_media")
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->join('harga_mitra_table', 'harga_mitra_table.peserta_didik_id = data_murid_table.id', 'left')
            // ->join('harga_mitra_table', 'presensi_table.mitra_pengajar_id = harga_mitra_table.mitra_pengajar_id ')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)

            ->orderBy('data_murid_table.nama_lengkap_anak asc')
            ->get()->getResultObject();
    }

    public function getInvoiceMitraWithMonthSum($mitra_pengajar_id, $bulan)
    {
        return $this->table($this->table)
            ->select('sum(harga_mitra_table.harga_mitra) as total')
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->join('harga_mitra_table', 'harga_mitra_table.peserta_didik_id = data_murid_table.id', 'left')
            // ->join('harga_mitra_table', 'presensi_table.mitra_pengajar_id = harga_mitra_table.mitra_pengajar_id ')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)

            ->orderBy('data_murid_table.nama_lengkap_anak asc')
            ->get()->getRowObject();
    }

    public function getMediaMitraWithMonthSum($mitra_pengajar_id, $bulan)
    {
        return $this->table($this->table)
            ->select('sum(harga_mitra_table.booster_media) as total_media')
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->join('harga_mitra_table', 'harga_mitra_table.peserta_didik_id = data_murid_table.id', 'left')
            // ->join('harga_mitra_table', 'presensi_table.mitra_pengajar_id = harga_mitra_table.mitra_pengajar_id ')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->orderBy('data_murid_table.nama_lengkap_anak asc')
            ->get()->getRowObject();
    }

    public function getPresensiPerMitra($mitra_pengajar_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("presensi_table.id, presensi_table.mitra_pengajar_id ,presensi_table.tanggal_masuk, presensi_table.jam_masuk,presensi_table.dokumentasi,data_murid_table.nama_lengkap_anak, data_pengajar_table.nama_lengkap, presensi_table.dokumentasi_orang_tua")
            ->join('kelompok_table', 'kelompok_table.mitra_pengajar_id = presensi_table.mitra_pengajar_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->where(["presensi_table.mitra_pengajar_id" => $mitra_pengajar_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->where('YEAR(presensi_table.tanggal_masuk)', $tahun)
            ->orderBy('presensi_table.tanggal_masuk desc')
            ->get()->getResultObject();
    }

    public function getPresensiPerAnak($peserta_didik_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("COUNT(MONTH(presensi_table.tanggal_masuk)) as total_presensi_perbulan, data_murid_table.id,  data_murid_table.nama_lengkap_anak, harga_table.harga, media_belajar_anak_table.harga_media, media_belajar_anak_table.lain_lain, media_belajar_anak_table.bulan, paket_belajar_table.jumlah_pertemuan, data_pengajar_table.nama_lengkap, presensi_table.mitra_pengajar_id")
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->join('data_pengajar_table', 'data_pengajar_table.id = presensi_table.mitra_pengajar_id')
            ->join('harga_table', 'harga_table.peserta_didik_id = data_murid_table.id')
            ->join('media_belajar_anak_table', 'media_belajar_anak_table.peserta_didik_id = data_murid_table.id')
            ->join('paket_belajar_table', 'paket_belajar_table.id = data_murid_table.paket_belajar_id')
            ->where(["data_murid_table.id" => $peserta_didik_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->where(['harga_table.bulan' => $bulan])
            ->where(['harga_table.tahun' => $tahun])
            ->where(['media_belajar_anak_table.bulan' => $bulan])
            ->where(['media_belajar_anak_table.tahun' => $tahun])
            ->orderBy('data_pengajar_table.nama_lengkap desc')
            ->get()->getResultObject();
    }


    public function getPresensiPerbulan($peserta_didik_id, $bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("COUNT(MONTH(presensi_table.tanggal_masuk)) as total_presensi_perbulan, data_murid_table.id,data_murid_table.uid_murid,data_murid_table.nama_lengkap_anak, data_murid_table.tanggal_lahir_anak, data_murid_table.usia_anak, data_murid_table.alamat_domisili_anak, data_murid_table.nama_ayah, data_murid_table.nama_ibu, data_murid_table.pekerjaan_ayah, data_murid_table.pekerjaan_ibu, data_murid_table.info_les, data_murid_table.data, data_murid_table.brosur, data_murid_table.sekolah_anak, data_murid_table.nomor_whatsapp_wali, data_murid_table. username_instagram_wali, data_murid_table.program_belajar_id, data_murid_table.materi_belajar_id, data_murid_table.hari_belajar, data_murid_table.waktu_belajar, data_murid_table.foto_anak, data_murid_table.status_murid_id, status_murid_table.status_murid,materi_belajar_table.level, program_belajar_table.nama_program, paket_belajar_table.nama_paket, paket_belajar_table.jumlah_pertemuan")
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->join('paket_belajar_table', 'paket_belajar_table.id = data_murid_table.paket_belajar_id', 'left')
            ->join('materi_belajar_table', 'materi_belajar_table.id = data_murid_table.materi_belajar_id')
            ->join('program_belajar_table', 'program_belajar_table.id = data_murid_table.program_belajar_id')
            ->where(["data_murid_table.id" => $peserta_didik_id])
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->where('YEAR(presensi_table.tanggal_masuk)', $tahun)
            ->orderBy('id desc')
            ->get()->getRowObject();
    }

    public function SumHargaPresensi($bulan, $tahun)
    {
        return $this->table($this->table)
            ->select("SUM(harga_table.harga) as total_harga")
            ->join('data_murid_table', 'data_murid_table.id = presensi_table.peserta_didik_id')
            ->join('harga_table', 'harga_table.peserta_didik_id = presensi_table.peserta_didik_id')
            ->join('media_belajar_anak_table', 'media_belajar_anak_table.peserta_didik_id = data_murid_table.id')
            ->where('MONTH(presensi_table.tanggal_masuk)', $bulan)
            ->where(['media_belajar_anak_table.bulan' => $bulan])
            ->where(['media_belajar_anak_table.tahun' => $tahun])
            ->where(['harga_table.bulan' => $bulan])
            ->where(['harga_table.tahun' => $tahun])
            ->get()->getRowObject();
    }
}
