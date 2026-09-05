<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStandarPredikat extends Migration
{
    public function up()
    {
        $fields = [
            'nilai_akhir' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                'after' => 'nilai_predikat'
            ],

        ];
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->addColumn('standar_predikat_apr_table', $fields, false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('standar_predikat_apr_table');
    }
}
