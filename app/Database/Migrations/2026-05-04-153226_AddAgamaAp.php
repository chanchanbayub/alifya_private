<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAgamaAp extends Migration
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
        $this->forge->addColumn('data_murid_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('data_murid_table');
    }
}
