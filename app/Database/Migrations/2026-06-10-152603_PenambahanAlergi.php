<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenambahanAlergi extends Migration
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
        $this->forge->addColumn('data_murid_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('data_murid_table');
    }
}
