<?php

namespace App\Models\Mitra;

use CodeIgniter\Model;

class MuridModel extends Model
{
    protected $table            = 'data_murid_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['uid_murid', 'nama_lengkap_anak', 'tanggal_lahir_anak', 'usia_anak', 'alamat_domisili_anak', 'sekolah_anak', 'nomor_whatsapp_wali', 'username_instagram_wali', 'program_belajar_id', 'materi_belajar_id', 'hari_belajar', 'waktu_belajar', 'foto_anak', 'status_murid_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDataMurid()
    {
        return $this->table($this->table)
            ->select("data_murid_table.id,data_murid_table.uid_murid,data_murid_table.nama_lengkap_anak, data_murid_table.tanggal_lahir_anak, data_murid_table.usia_anak, data_murid_table.alamat_domisili_anak, data_murid_table.sekolah_anak, data_murid_table.nomor_whatsapp_wali, data_murid_table. username_instagram_wali, data_murid_table.paket_belajar_id, data_murid_table.info_les, data_murid_table.brosur, data_murid_table.data ,data_murid_table.program_belajar_id, data_murid_table.materi_belajar_id, data_murid_table.hari_belajar, data_murid_table.waktu_belajar, data_murid_table.foto_anak, data_murid_table.status_murid_id, status_murid_table.status_murid,materi_belajar_table.program_belajar_id, program_belajar_table.nama_program, paket_belajar_table.nama_paket, paket_belajar_table.jumlah_pertemuan")
            ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->join('paket_belajar_table', 'paket_belajar_table.id = data_murid_table.paket_belajar_id', 'left')
            ->join('program_belajar_table', 'program_belajar_table.id = data_murid_table.program_belajar_id')
            ->join('materi_belajar_table', 'materi_belajar_table.id = data_murid_table.materi_belajar_id')
            ->orderBy('id desc')
            ->get()->getResultObject();
    }

    public function getMitraMurid($id)
    {
        return $this->table($this->table)
            ->select("data_murid_table.id,data_murid_table.uid_murid,data_murid_table.nama_lengkap_anak, data_murid_table.tanggal_lahir_anak, data_murid_table.usia_anak, data_murid_table.alamat_domisili_anak, data_murid_table.nama_ayah, data_murid_table.nama_ibu, data_murid_table.pekerjaan_ayah, data_murid_table.pekerjaan_ibu, data_murid_table.info_les, data_murid_table.data, data_murid_table.brosur, data_murid_table.sekolah_anak, data_murid_table.nomor_whatsapp_wali, data_murid_table. username_instagram_wali, data_murid_table.program_belajar_id, data_murid_table.materi_belajar_id, data_murid_table.hari_belajar, data_murid_table.waktu_belajar, data_murid_table.foto_anak, data_murid_table.status_murid_id, status_murid_table.status_murid,materi_belajar_table.level, program_belajar_table.nama_program, paket_belajar_table.nama_paket, paket_belajar_table.jumlah_pertemuan")
            ->join('status_murid_table', 'status_murid_table.id = data_murid_table.status_murid_id')
            ->join('paket_belajar_table', 'paket_belajar_table.id = data_murid_table.paket_belajar_id', 'left')
            ->join('materi_belajar_table', 'materi_belajar_table.id = data_murid_table.materi_belajar_id')
            ->join('program_belajar_table', 'program_belajar_table.id = data_murid_table.program_belajar_id')
            ->where(["data_murid_table.id" => $id])
            ->orderBy('id desc')
            ->get()->getRowObject();
    }
}