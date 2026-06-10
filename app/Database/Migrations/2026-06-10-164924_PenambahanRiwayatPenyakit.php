<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenambahanRiwayatPenyakit extends Migration
{
    public function up()
    {
        $fields = [
            'riwayat_penyakit' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'after' => 'sekolah_anak'
            ],
        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('peserta_didik_ahl_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('peserta_didik_ahl_table');
    }
}
