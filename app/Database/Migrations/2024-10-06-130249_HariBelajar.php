<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HariBelajar extends Migration
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

            'nama_hari' => [
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
        $this->forge->createTable('hari_belajar_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('hari_belajar_table');
    }
}
