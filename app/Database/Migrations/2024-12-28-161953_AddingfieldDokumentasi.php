<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddingfieldDokumentasi extends Migration
{
    public function up()
    {
        $fields = [
            'dokumentasi_orang_tua' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'after' => 'peserta_didik_id'
            ],

        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('presensi_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('presensi_table');
    }
}
