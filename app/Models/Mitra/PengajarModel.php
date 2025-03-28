<?php

namespace App\Models\Mitra;

use CodeIgniter\Model;

class PengajarModel extends Model
{
    protected $table            = 'data_pengajar_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['uid', 'nama_lengkap', 'email', 'usia', 'tanggal_lahir_mitra', 'alamat_domisili', 'pendidikan_terakhir', 'jurusan', 'status_perkawinan', 'nomor_whatsapp', 'username_instagram', 'pekerjaan', 'kontrak', 'pernyataan', 'kendaraan_pribadi', 'media_belajar', 'alasan_bergabung', 'kelebihan', 'info_loker', 'ijazah', 'foto', 'cv', 'status_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDataPengajar()
    {
        return $this->table($this->table)
            ->select("data_pengajar_table.id, data_pengajar_table.uid, data_pengajar_table.nama_lengkap, data_pengajar_table.email, data_pengajar_table.usia, data_pengajar_table.tanggal_lahir_mitra, ,data_pengajar_table.alamat_domisili, data_pengajar_table.pendidikan_terakhir, data_pengajar_table.jurusan, status_perkawinan, data_pengajar_table.nomor_whatsapp, data_pengajar_table.username_instagram, data_pengajar_table.foto, data_pengajar_table.cv, data_pengajar_table.status_id, status_pengajar_table.status_pengajar,data_pengajar_table.pekerjaan")
            ->join('status_pengajar_table', 'status_pengajar_table.id = data_pengajar_table.status_id')
            ->orderBy('id desc')
            ->get()->getResultObject();
    }

    public function getMitraPengajarWithId($id)
    {
        return $this->table($this->table)
            ->select("data_pengajar_table.id, data_pengajar_table.uid, data_pengajar_table.nama_lengkap, data_pengajar_table.email, data_pengajar_table.usia, data_pengajar_table.tanggal_lahir_mitra ,data_pengajar_table.alamat_domisili, data_pengajar_table.pendidikan_terakhir, data_pengajar_table.jurusan, status_perkawinan, data_pengajar_table.nomor_whatsapp, data_pengajar_table.username_instagram, data_pengajar_table.foto, data_pengajar_table.cv, data_pengajar_table.status_id, status_pengajar_table.status_pengajar, data_pengajar_table.ijazah")
            ->join('status_pengajar_table', 'status_pengajar_table.id = data_pengajar_table.status_id')
            ->where(["data_pengajar_table.id" => $id])
            ->orderBy('id desc')
            ->get()->getResultObject();
    }

    public function getMitraPengajar($email)
    {
        return $this->table($this->table)
            ->select("data_pengajar_table.id, data_pengajar_table.uid, data_pengajar_table.nama_lengkap, data_pengajar_table.email, data_pengajar_table.usia, data_pengajar_table.tanggal_lahir_mitra ,data_pengajar_table.alamat_domisili, data_pengajar_table.pendidikan_terakhir, data_pengajar_table.jurusan, status_perkawinan, data_pengajar_table.nomor_whatsapp, data_pengajar_table.username_instagram, data_pengajar_table.foto, data_pengajar_table.cv, data_pengajar_table.status_id, data_pengajar_table.pekerjaan, data_pengajar_table.pernyataan, data_pengajar_table.kendaraan_pribadi,data_pengajar_table.media_belajar, data_pengajar_table.alasan_bergabung, data_pengajar_table.kelebihan, data_pengajar_table.info_loker, data_pengajar_table.ijazah, data_pengajar_table.kontrak, status_pengajar_table.status_pengajar, data_pengajar_table.tanggal_lahir_mitra")
            ->join('status_pengajar_table', 'status_pengajar_table.id = data_pengajar_table.status_id')
            ->where(["data_pengajar_table.email" => $email])
            ->orderBy('id desc')
            ->get()->getRowObject();
    }
}
