<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class PesertaDidikAhlModel extends Model
{
    protected $table            = 'peserta_didik_ahl_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id', 'ketersediaan', 'nama_ayah', 'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu', 'usersname_instagram', 'nomor_whatsapp_orang_tua', 'alamat_domisili_anak', 'nama_lengkap_anak', 'nama_panggilan_anak', 'tanggal_lahir_anak', 'jenis_kelamin', 'pendidikan_id', 'sekolah_anak', 'ukuran_baju', 'program_belajar_ahl_id', 'jumlah_pertemuan_id', 'foto_anak', 'bukti_tf', 'izin_dokumentasi', 'info_alifya', 'data_1', 'data_2', 'status_peserta_id', 'tanggal_bergabung'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPesertaAhl()
    {
        $db = db_connect();
        $builder = $db->table($this->table);

        $builder = $builder->select('peserta_didik_ahl_table.id, peserta_didik_ahl_table.nama_lengkap_anak, peserta_didik_ahl_table.status_peserta_id, status_murid_table.status_murid')
            ->join('status_murid_table', 'status_murid_table.id = peserta_didik_ahl_table.status_peserta_id');
        return $builder->orderBy('peserta_didik_ahl_table.nama_lengkap_anak asc');
    }

    public function getProfil($id)
    {
        return $this->table($this->table)
            ->select("peserta_didik_ahl_table.id, peserta_didik_ahl_table.ketersediaan, peserta_didik_ahl_table.nama_ayah, peserta_didik_ahl_table.pekerjaan_ayah, peserta_didik_ahl_table.pekerjaan_ibu, peserta_didik_ahl_table.nama_ibu,, peserta_didik_ahl_table.usersname_instagram, peserta_didik_ahl_table.nomor_whatsapp_orang_tua, peserta_didik_ahl_table.alamat_domisili_anak, peserta_didik_ahl_table.nama_lengkap_anak, peserta_didik_ahl_table.nama_lengkap_anak, peserta_didik_ahl_table.nama_panggilan_anak, peserta_didik_ahl_table.tanggal_lahir_anak, peserta_didik_ahl_table.jenis_kelamin, peserta_didik_ahl_table.pendidikan_id, peserta_didik_ahl_table.sekolah_anak, peserta_didik_ahl_table.ukuran_baju, peserta_didik_ahl_table.program_belajar_ahl_id,peserta_didik_ahl_table.jumlah_pertemuan_id ,peserta_didik_ahl_table.foto_anak, peserta_didik_ahl_table.bukti_tf, peserta_didik_ahl_table.izin_dokumentasi, peserta_didik_ahl_table.info_alifya, peserta_didik_ahl_table.data_2, peserta_didik_ahl_table.data_1, peserta_didik_ahl_table.status_peserta_id, program_ahl_table.nama_program, status_murid_table.status_murid, tingkat_pendidikan_table.pendidikan, peserta_didik_ahl_table.tanggal_bergabung, price_list_table.jumlah_pertemuan")
            ->join('program_ahl_table', 'program_ahl_table.id = peserta_didik_ahl_table.program_belajar_ahl_id')
            ->join('tingkat_pendidikan_table', 'tingkat_pendidikan_table.id = peserta_didik_ahl_table.id')
            ->join('price_list_table', 'price_list_table.id = peserta_didik_ahl_table.jumlah_pertemuan_id')
            ->join('status_murid_table', 'status_murid_table.id = peserta_didik_ahl_table.status_peserta_id')
            ->where(["peserta_didik_ahl_table.id" => $id])
            ->orderBy('peserta_didik_ahl_table.id desc')
            ->get()->getRowObject();
    }
}
