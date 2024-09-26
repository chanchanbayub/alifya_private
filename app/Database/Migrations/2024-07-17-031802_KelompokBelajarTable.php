<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KelompokBelajarTable extends Migration
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

            'kelompok_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],

            'peserta_didik_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
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
        $this->forge->addForeignKey('kelompok_id', 'kelompok_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('peserta_didik_id', 'data_murid_table', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kelompok_belajar_table', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('kelompok_belajar_table');
    }
}
