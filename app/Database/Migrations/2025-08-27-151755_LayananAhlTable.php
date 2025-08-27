<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LayananAhlTable extends Migration
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

            'nama_layanan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null'      => true
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
        $this->forge->createTable('layanan_ahl_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('layanan_ahl_table');
    }
}
