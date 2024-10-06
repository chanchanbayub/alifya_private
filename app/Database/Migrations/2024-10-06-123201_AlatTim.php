<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlatTim extends Migration
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

            'keterangan' => [
                'type'           => 'Varchar',
                'constraint'     => 100,
            ],
            'links' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
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
        $this->forge->createTable('alat_tim_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('alat_tim_table');
    }
}
