<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAgama extends Migration
{
    public function up()
    {
        $fields = [
            'agama' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'after' => 'pekerjaan_ibu'
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
