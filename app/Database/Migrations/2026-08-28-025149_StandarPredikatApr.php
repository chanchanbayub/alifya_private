<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StandarPredikatApr extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'predikat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'nilai_predikat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'created_at' => [
                'type' => 'datetime',

            ],
            'updated_at' => [
                'type' => 'datetime',

            ],
        ]);
        $this->forge->addKey('id', true);
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('standar_predikat_apr_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('standar_predikat_apr_table');
    }
}
