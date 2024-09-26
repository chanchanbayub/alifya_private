<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveTanggalPergantianAbsensi extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('absensi_table', 'pergantian_jadwal');
    }

    public function down()
    {
        $this->forge->dropColumn('absensi_table', 'pergantian_jadwal');
    }
}
