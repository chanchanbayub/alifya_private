<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddInfoModulAp extends Migration
{
    public function up()
    {
        $fields = [
            'info_modul' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'after' => 'ketersediaan'
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
