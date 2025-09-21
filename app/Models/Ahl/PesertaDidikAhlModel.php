<?php

namespace App\Models\Ahl;

use CodeIgniter\Model;

class PesertaDidikAhlModel extends Model
{
    protected $table            = 'peserta_didik_ahl_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id', 'ketersediaan', 'nama_ayah', 'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu', 'usersname_instagram', 'nomor_whatsapp_orang_tua', 'alamat_domisili_anak', 'nama_lengkap_anak', 'nama_panggilan_anak', 'tanggal_lahir_anak', 'jenis_kelamin', 'pendidikan', 'sekolah_anak', 'ukuran_baju', 'program_belajar_ahl_id', 'foto_anak', 'bukti_tf', 'izin_dokumentasi', 'info_alifya', 'data_1', 'data_2', 'status_peserta_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
