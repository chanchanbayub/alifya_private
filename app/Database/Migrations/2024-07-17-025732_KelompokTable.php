<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KelompokTable extends Migration
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

            'kelompok' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

            'mitra_pengajar_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
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
        $this->forge->addForeignKey('mitra_pengajar_id', 'data_pengajar_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kelompok_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('kelompok_table');
    }
}
